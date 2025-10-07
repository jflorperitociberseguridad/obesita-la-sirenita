// api/generate.js - Versión COMPLETA y de Diagnóstico

export default async function handler(req, res) {
    // --- PASO 1: Inicio y comprobaciones ---
    console.log("--- INICIO DE LA FUNCIÓN API ---");
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

    if (req.method === 'OPTIONS') {
        console.log("Recibida solicitud OPTIONS (pre-vuelo).");
        return res.status(200).end();
    }
    
    if (req.method !== 'POST') {
        console.error("Error: Método no permitido:", req.method);
        return res.status(405).json({ error: 'Método no permitido.' });
    }

    const API_KEY = process.env.GEMINI_API_KEY;

    if (!API_KEY) {
        console.error("¡ERROR CRÍTICO! GEMINI_API_KEY no se encontró en Vercel.");
        return res.status(500).json({ error: "Error del servidor: La clave API no está configurada." });
    }
    console.log("Clave API encontrada.");

    try {
        // --- PASO 2: Procesar la solicitud ---
        const { type, payload } = req.body;
        console.log(`Petición recibida. Tipo: '${type}'`);

        if (!type || !payload) {
            console.error("Error: La solicitud no tiene 'type' o 'payload'.");
            return res.status(400).json({ error: "Solicitud mal formada." });
        }

        let apiUrl = '';
        let apiPayload = {};
        let model = 'gemini-1.5-flash-latest'; // Modelo por defecto para texto

        // --- PASO 3: Configurar la llamada a Google según el tipo ---
        console.log("Configurando la llamada para el tipo:", type);
        switch (type) {
            case 'generateStoryText':
            case 'continueStory':
            case 'explainValue':
            case 'getPlayIdeas':
                apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/${model}:generateContent?key=${API_KEY}`;
                apiPayload = {
                    contents: [{ parts: [{ text: payload.prompt }] }],
                    systemInstruction: { parts: [{ text: payload.systemPrompt }] },
                };
                break;

            case 'generateImage':
                apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/imagen-3.0-generate-002:predict?key=${API_KEY}`;
                apiPayload = {
                    instances: [{ prompt: payload.prompt }],
                    parameters: { "sampleCount": 1 }
                };
                break;

            case 'generateAudio':
                apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-tts:generateContent?key=${API_KEY}`;
                apiPayload = {
                    contents: [{ parts: [{ text: payload.prompt }] }],
                    generationConfig: { responseModalities: ["AUDIO"] },
                    model: "gemini-2.5-flash-preview-tts"
                };
                break;
            
            default:
                console.error("Error: Tipo de solicitud desconocido:", type);
                return res.status(400).json({ error: `Tipo de solicitud desconocido: ${type}` });
        }
        
        console.log("URL de la API de Google a la que se llamará:", apiUrl);
        
        // --- PASO 4: Realizar la llamada a Google ---
        console.log("Realizando la llamada fetch a Google...");
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(apiPayload)
        });
        
        console.log(`Respuesta recibida de Google. Código de estado: ${response.status}`);

        if (!response.ok) {
            const errorText = await response.text();
            console.error("¡ERROR DE GOOGLE! La API devolvió un error:", errorText);
            throw new Error(`Error en la API de Google (${response.status})`);
        }

        const data = await response.json();
        console.log("Datos JSON de Google procesados correctamente.");

        // --- PASO 5: Devolver la respuesta al cliente ---
        let result = {};
        switch (type) {
            case 'generateStoryText':
            case 'continueStory':
            case 'explainValue':
            case 'getPlayIdeas':
                result.text = data.candidates?.[0]?.content?.parts?.[0]?.text;
                break;
            case 'generateImage':
                result.imageUrl = `data:image/png;base64,${data.predictions?.[0]?.bytesBase64Encoded}`;
                break;
            case 'generateAudio':
                result.audioData = data.candidates?.[0]?.content?.parts?.[0]?.inlineData?.data;
                result.mimeType = data.candidates?.[0]?.content?.parts?.[0]?.inlineData?.mimeType;
                break;
        }

        if (Object.values(result).every(v => !v)) {
             console.error("Error: La respuesta de Google no contenía los datos esperados. Respuesta completa:", JSON.stringify(data, null, 2));
             throw new Error("Formato de respuesta de Google inesperado.");
        }
        
        console.log("Respuesta preparada para enviar al cliente. ¡Éxito!");
        console.log("--- FIN DE LA FUNCIÓN API ---");
        return res.status(200).json(result);

    } catch (error) {
        // --- MANEJO DE ERRORES ---
        console.error("¡ERROR CATASTRÓFICO DENTRO DE LA FUNCIÓN!", error.message);
        console.log("--- FIN DE LA FUNCIÓN API (CON ERROR) ---");
        return res.status(500).json({ error: `Ocurrió un error en el servidor: ${error.message}` });
    }
}

