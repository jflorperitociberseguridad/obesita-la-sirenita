// api/generate.js - Versión de Diagnóstico con Logs Detallados

export default async function handler(req, res) {
    // --- PASO 1: Inicio de la función y obtención de la clave ---
    console.log("--- INICIO DE LA FUNCIÓN API ---");

    // Añadimos cabeceras CORS para permitir la comunicación desde tu dominio
    res.setHeader('Access-Control-Allow-Origin', '*'); // Puedes restringirlo a tu dominio Vercel si lo deseas
    res.setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

    // Manejo de la solicitud pre-vuelo OPTIONS
    if (req.method === 'OPTIONS') {
        console.log("Recibida solicitud OPTIONS (pre-vuelo). Respondiendo OK.");
        return res.status(200).end();
    }
    
    // Solo permitimos el método POST
    if (req.method !== 'POST') {
        console.error("Error: Se recibió un método no permitido:", req.method);
        return res.status(405).json({ error: 'Método no permitido. Solo se acepta POST.' });
    }

    const API_KEY = process.env.GEMINI_API_KEY;

    if (!API_KEY) {
        console.error("¡ERROR CRÍTICO! La variable de entorno GEMINI_API_KEY no se encontró.");
        return res.status(500).json({ error: "Error del servidor: La clave API no está configurada en Vercel. Revisa las 'Environment Variables'." });
    }
    console.log("Clave API encontrada en las variables de entorno.");

    try {
        // --- PASO 2: Procesar la solicitud del cliente ---
        const { type, payload } = req.body;
        console.log(`Petición recibida. Tipo: ${type}`);
        console.log("Payload recibido:", JSON.stringify(payload, null, 2));

        if (!type || !payload) {
            console.error("Error: La solicitud no tiene 'type' o 'payload'.");
            return res.status(400).json({ error: "Solicitud mal formada. Faltan 'type' o 'payload'." });
        }

        let apiUrl = '';
        let apiPayload = {};

        // --- PASO 3: Preparar la llamada a la API de Google correcta ---
        switch (type) {
            case 'generateStoryText':
                apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=${API_KEY}`;
                apiPayload = {
                    contents: [{ parts: [{ text: payload.prompt }] }],
                    systemInstruction: { parts: [{ text: payload.systemPrompt }] },
                };
                console.log("Configurando para generar texto de cuento.");
                break;

            case 'generateImage':
                 apiUrl = `https://us-central1-aiplatform.googleapis.com/v1/projects/TU_ID_DE_PROYECTO_GOOGLE_CLOUD/locations/us-central1/publishers/google/models/imagegeneration:predict`;
                apiPayload = {
                    instances: [{ prompt: payload.prompt }],
                    parameters: { "sampleCount": 1 }
                };
                console.log("Configurando para generar imagen. IMPORTANTE: Necesitas un token de acceso, no solo una API Key para este modelo.");
                break;

            case 'generateAudio':
                apiUrl = `https://texttospeech.googleapis.com/v1/text:synthesize?key=${API_KEY}`;
                apiPayload = {
                    input: { text: payload.prompt },
                    voice: { languageCode: 'es-ES', name: 'es-ES-Wavenet-B' },
                    audioConfig: { audioEncoding: 'MP3' }
                };
                console.log("Configurando para generar audio.");
                break;
            
            default:
                console.error("Error: Tipo de solicitud desconocido:", type);
                return res.status(400).json({ error: `Tipo de solicitud desconocido: ${type}` });
        }
        
        console.log("URL de la API de Google a la que se llamará:", apiUrl);
        console.log("Payload que se enviará a Google:", JSON.stringify(apiPayload, null, 2));
        
        // --- PASO 4: Realizar la llamada a la API de Google ---
        console.log("Realizando la llamada fetch a Google...");
        
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(apiPayload)
        });
        
        console.log(`Respuesta recibida de Google. Código de estado: ${response.status} ${response.statusText}`);

        if (!response.ok) {
            const errorText = await response.text();
            console.error("¡ERROR DE GOOGLE! La API devolvió un error:", errorText);
            throw new Error(`Error en la API de Google (${response.status}): ${errorText}`);
        }

        const data = await response.json();
        console.log("Datos JSON recibidos de Google procesados correctamente.");

        // --- PASO 5: Devolver la respuesta al cliente ---
        let result;
        switch (type) {
            case 'generateStoryText':
            case 'continueStory':
            case 'explainValue':
            case 'getPlayIdeas':
                result = data.candidates?.[0]?.content?.parts?.[0]?.text;
                break;
            case 'generateImage':
                result = `data:image/png;base64,${data.predictions?.[0]?.bytesBase64Encoded}`;
                break;
            case 'generateAudio':
                result = `data:audio/mp3;base64,${data.audioContent}`;
                break;
        }

        if (!result) {
            console.error("Error: La respuesta de Google no contenía los datos esperados.");
            console.log("Respuesta completa de Google:", JSON.stringify(data, null, 2));
            throw new Error("Formato de respuesta de Google inesperado.");
        }
        
        console.log("Respuesta preparada para enviar al cliente. ¡Éxito!");
        console.log("--- FIN DE LA FUNCIÓN API ---");
        return res.status(200).json({ result });

    } catch (error) {
        // --- MANEJO DE ERRORES ---
        console.error("¡ERROR CATASTRÓFICO DENTRO DE LA FUNCIÓN!", error);
        console.log("--- FIN DE LA FUNCIÓN API (CON ERROR) ---");
        return res.status(500).send(`A server error occurred: ${error.message}`);
    }
}

