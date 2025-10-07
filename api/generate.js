// api/generate.js - Backend seguro y robusto para la API de Gemini

// --- FUNCIÓN PRINCIPAL (Handler de Vercel) ---
export default async function handler(req) {
    // --- PASO 1: Comprobación de Seguridad Esencial ---
    // Verifica si la clave API está disponible. Si no, devuelve un error claro.
    // Esta es la causa más común de fallos.
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

        const { type, payload } = await req.json();
        
        // --- PASO 3: Selección de la Tarea a Realizar ---
        switch (type) {
            case 'generateStoryText':
                return await generateStoryText(payload);
            case 'generateImage':
                return await generateImage(payload);
            case 'generateAudio':
                return await generateAudio(payload);
            case 'explainValue':
                return await explainValue(payload);
            case 'getPlayIdeas':
                return await getPlayIdeas(payload);
            case 'continueStory':
                 return await continueStory(payload);
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


// --- FUNCIONES DE LA API DE GEMINI ---

const API_KEY = process.env.GEMINI_API_KEY;

// Genera el texto de un cuento
async function generateStoryText({ character, value, setting }) {
    const systemPrompt = "Eres un escritor experto en cuentos infantiles para niños de 4 a 8 años. Tu estilo es tierno, positivo y visual. Escribe en español un cuento muy corto (entre 100 y 150 palabras) que tenga un final feliz y que enseñe un valor de forma clara y sencilla. El cuento debe ser fácil de leer en voz alta. Usa los elementos que te proporcionará el usuario.";
    const userQuery = `El personaje principal es ${character}. El valor a enseñar es ${value}. El cuento sucede en ${setting}.`;
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=${API_KEY}`;
    
    const requestBody = {
        contents: [{ parts: [{ text: userQuery }] }],
        systemInstruction: { parts: [{ text: systemPrompt }] },
    };

    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });
    
    if (!response.ok) throw new Error(`Error en la API de texto: ${response.statusText}`);
    const data = await response.json();
    const text = data.candidates?.[0]?.content?.parts?.[0]?.text;
    if (!text) throw new Error("No se pudo extraer el texto de la respuesta de la API.");
    
    return new Response(JSON.stringify({ text }), { headers: { 'Content-Type': 'application/json' } });
}

// Genera una ilustración para el cuento
async function generateImage({ character, value, setting }) {
    const imagePrompt = `A whimsical and colorful children's book illustration of: ${character}, in ${setting}. The scene visually represents the value of ${value}. Cute, vibrant, heartwarming, storybook style, soft lighting.`;
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/imagen-3.0-generate-002:predict?key=${API_KEY}`;
    
    const requestBody = {
        instances: [{ prompt: imagePrompt }],
        parameters: { "sampleCount": 1 }
    };
    
    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });

    if (!response.ok) throw new Error(`Error en la API de imagen: ${response.statusText}`);
    const data = await response.json();
    const base64Data = data.predictions?.[0]?.bytesBase64Encoded;
    if (!base64Data) throw new Error("No se recibió una imagen válida de la API.");
    
    const imageUrl = `data:image/png;base64,${base64Data}`;
    return new Response(JSON.stringify({ imageUrl }), { headers: { 'Content-Type': 'application/json' } });
}

// Genera el audio de un texto
async function generateAudio({ text }) {
    const prompt = `Di con una voz dulce y amigable, como si contaras un cuento a un niño: ${text}`;
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
    
    if (!response.ok) throw new Error(`Error en la API TTS: ${response.statusText}`);
    const data = await response.json();
    const audioData = data.candidates?.[0]?.content?.parts?.[0]?.inlineData?.data;
    const mimeType = data.candidates?.[0]?.content?.parts?.[0]?.inlineData?.mimeType;

    if (!audioData || !mimeType.startsWith("audio/")) throw new Error("Respuesta de audio inválida.");

    return new Response(JSON.stringify({ audioData, mimeType }), { headers: { 'Content-Type': 'application/json' } });
}

// Explica un valor
async function explainValue({ value }) {
    const systemPrompt = "Actúa como un educador infantil. Explícame en español qué es un valor de una forma muy sencilla y con un ejemplo claro, como si se lo contaras a un niño de 5 años. Tu respuesta debe ser cálida, fácil de entender y un poco más detallada. Usa entre 80 y 120 palabras.";
    const userQuery = `El valor es: "${value}".`;
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=${API_KEY}`;

    const requestBody = {
        contents: [{ parts: [{ text: userQuery }] }],
        systemInstruction: { parts: [{ text: systemPrompt }] },
    };
    
    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });

    if (!response.ok) throw new Error(`Error en la API de explicación: ${response.statusText}`);
    const data = await response.json();
    const text = data.candidates?.[0]?.content?.parts?.[0]?.text;
    if (!text) throw new Error("No se pudo generar la explicación del valor.");
    
    return new Response(JSON.stringify({ text }), { headers: { 'Content-Type': 'application/json' } });
}

// Sugiere ideas para jugar
async function getPlayIdeas({ value, explanation }) {
    const systemPrompt = "Eres un pedagogo creativo y amigable. Basándote en el valor y su explicación, sugiere 2 o 3 actividades o juegos muy sencillos y prácticos que un padre pueda hacer con su hijo para poner en práctica ese valor. Escribe en español, en un formato de lista con puntos (usando '-' o '*'). Sé breve y directo.";
    const userQuery = `El valor es "${value}" y la explicación que se le ha dado al niño es: "${explanation}". Dame ideas para jugar.`;
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=${API_KEY}`;
    
    const requestBody = {
        contents: [{ parts: [{ text: userQuery }] }],
        systemInstruction: { parts: [{ text: systemPrompt }] },
    };
    
    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });

    if (!response.ok) throw new Error(`Error en la API de ideas: ${response.statusText}`);
    const data = await response.json();
    const text = data.candidates?.[0]?.content?.parts?.[0]?.text;
    if (!text) throw new Error("No se pudieron generar las ideas de juego.");
    
    return new Response(JSON.stringify({ text }), { headers: { 'Content-Type': 'application/json' } });
}

// Continúa un cuento
async function continueStory({ story }) {
    const systemPrompt = "Eres un escritor de cuentos infantiles. Continúa la siguiente historia con un segundo párrafo corto (entre 80 y 120 palabras) que sea igual de emocionante y mantenga el mismo tono tierno y positivo. Escribe en español.";
    const userQuery = `Continúa esta historia: "${story}"`;
    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=${API_KEY}`;
    
    const requestBody = {
        contents: [{ parts: [{ text: userQuery }] }],
        systemInstruction: { parts: [{ text: systemPrompt }] },
    };

    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestBody)
    });
    
    if (!response.ok) throw new Error(`Error en la API de continuación: ${response.statusText}`);
    const data = await response.json();
    const text = data.candidates?.[0]?.content?.parts?.[0]?.text;
    if (!text) throw new Error("No se pudo continuar la historia.");

    return new Response(JSON.stringify({ text }), { headers: { 'Content-Type': 'application/json' } });
}

