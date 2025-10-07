// api/generate.js - Versión Final Corregida

// --- FUNCIÓN PRINCIPAL (Handler de Vercel) ---
export default async function handler(req) {
    // --- PASO 1: Comprobación de Seguridad Esencial ---
    if (!process.env.GEMINI_API_KEY) {
        console.error("Error Crítico: La variable de entorno GEMINI_API_KEY no está configurada en Vercel.");
        return new Response(JSON.stringify({
            error: "Error del servidor: La clave API no está configurada. Por favor, revisa la configuración en Vercel."
        }), {
            status: 500,
            headers: { 'Content-Type': 'application/json' }
        });
    }

    // --- PASO 2: Procesamiento de la Solicitud del Cliente ---
    try {
        if (req.method !== 'POST') {
            return new Response(JSON.stringify({ error: 'Método no permitido. Solo se aceptan solicitudes POST.' }), { status: 405 });
        }

        const { type, payload } = req.body;

        if (!type || !payload) {
             return new Response(JSON.stringify({ error: 'Solicitud mal formada.' }), { status: 400 });
        }
        
        // --- PASO 3: Selección de la Tarea a Realizar ---
        switch (type) {
            case 'generateText':
                return await generateText(payload);
            case 'generateImage':
                return await generateImage(payload);
            case 'generateAudio':
                return await generateAudio(payload);
            default:
                return new Response(JSON.stringify({ error: 'Tipo de acción no válida.' }), { status: 400 });
        }
    } catch (error) {
        console.error("Error inesperado en el handler principal:", error);
        return new Response(JSON.stringify({
            error: `Error interno del servidor: ${error.message}`
        }), {
            status: 500,
            headers: { 'Content-Type': 'application/json' }
        });
    }
}


// --- FUNCIONES AUXILIARES DE LA API DE GEMINI ---

const API_KEY = process.env.GEMINI_API_KEY;

// Función Genérica para generar Texto
async function generateText(payload) {
    const { systemPrompt, prompt } = payload;
    if (!prompt) {
        throw new Error("El 'prompt' es requerido para generar texto.");
    }
    // --- LA CORRECCIÓN FINAL ESTÁ AQUÍ ---
    // Usamos el modelo 'gemini-2.0-flash-001' que SÍ aparece en tu lista de Google Cloud.
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-001:generateContent?key=${API_KEY}`;
    
    const requestBody = {
        contents: [{ parts: [{ text: prompt }] }],
        ...(systemPrompt && { systemInstruction: { parts: [{ text: systemPrompt }] } }),
    };

    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });
    
    if (!response.ok) {
        const errorText = await response.text();
        console.error(`Error en la API de texto:`, errorText);
        throw new Error(`Error en la API de texto: ${response.statusText}`);
    }
    const data = await response.json();
    const text = data.candidates?.[0]?.content?.parts?.[0]?.text;
    if (!text) throw new Error("No se pudo extraer el texto de la respuesta de la API.");
    
    return new Response(JSON.stringify({ text }), { headers: { 'Content-Type': 'application/json' } });
}

// Función para generar una ilustración
async function generateImage({ prompt }) {
    if (!prompt) {
        throw new Error("El 'prompt' es requerido para generar una imagen.");
    }
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/imagen-3.0-generate-002:predict?key=${API_KEY}`;
    
    const requestBody = {
        instances: [{ prompt: prompt }],
        parameters: { "sampleCount": 1 }
    };
    
    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });

    if (!response.ok) {
        const errorText = await response.text();
        console.error(`Error en la API de imagen:`, errorText);
        throw new Error(`Error en la API de imagen: ${response.statusText}`);
    }
    const data = await response.json();
    const base64Data = data.predictions?.[0]?.bytesBase64Encoded;
    if (!base64Data) throw new Error("No se recibió una imagen válida de la API.");
    
    const imageUrl = `data:image/png;base64,${base64Data}`;
    return new Response(JSON.stringify({ imageUrl }), { headers: { 'Content-Type': 'application/json' } });
}

// Función para generar el audio de un texto
async function generateAudio({ prompt }) {
    if (!prompt) {
        throw new Error("El 'prompt' es requerido para generar audio.");
    }
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-tts:generateContent?key=${API_KEY}`;
    
    const requestBody = {
        contents: [{ parts: [{ text: prompt }] }],
        generationConfig: { responseModalities: ["AUDIO"] },
        model: "gemini-2.5-flash-preview-tts"
    };

    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });
    
    if (!response.ok) {
        const errorText = await response.text();
        console.error(`Error en la API de audio:`, errorText);
        throw new Error(`Error en la API TTS: ${response.statusText}`);
    }
    const data = await response.json();
    const audioData = data.candidates?.[0]?.content?.parts?.[0]?.inlineData?.data;
    const mimeType = data.candidates?.[0]?.content?.parts?.[0]?.inlineData?.mimeType;

    if (!audioData || !mimeType) throw new Error("Respuesta de audio inválida.");

    return new Response(JSON.stringify({ audioData, mimeType }), { headers: { 'Content-Type': 'application/json' } });
}

