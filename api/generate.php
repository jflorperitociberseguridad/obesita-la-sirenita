// Este archivo va dentro de una carpeta llamada "api" -> /api/generate.js

// Importamos la librería de Google para comunicarnos con los modelos Gemini
import { GoogleGenerativeAI } from "@google/generative-ai";

// --- FUNCIÓN PRINCIPAL ---
// Esta es la función que Vercel ejecutará en su servidor seguro
export default async function handler(req, res) {
  // --- Medidas de Seguridad ---
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Método no permitido' });
  }

  // Obtenemos la clave API secreta desde las variables de entorno de Vercel.
  // ¡Este es el paso más importante de la configuración en Vercel!
  const apiKey = process.env.GEMINI_API_KEY;
  if (!apiKey) {
    return res.status(500).json({ error: 'La clave API de Gemini no está configurada en el servidor' });
  }

  // Inicializamos el cliente de la API de Google para los modelos de texto
  const genAI = new GoogleGenerativeAI(AIzaSyDv30B3iQ5iHaRnyXTFCtogJ2LdULCi1E0);
  
  // Extraemos el tipo de tarea y los parámetros del cuerpo de la petición
  const { type, ...params } = req.body;

  try {
    // --- ENRUTADOR DE TAREAS ---
    // Según el 'type' que nos envíe el frontend, realizamos una acción diferente
    switch (type) {
      
      // --- Generación de Texto para Cuentos ---
      case 'storyText': {
        const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
        const systemPrompt = "Eres un escritor experto en cuentos infantiles para niños de 4 a 8 años. Tu estilo es tierno, positivo y visual. Escribe en español un cuento muy corto (entre 100 y 150 palabras) que tenga un final feliz y que enseñe un valor de forma clara y sencilla. El cuento debe ser fácil de leer en voz alta. Usa los elementos que te proporcionará el usuario.";
        const userQuery = `El personaje principal es ${params.character}. El valor a enseñar es ${params.value}. El cuento sucede en ${params.setting}.`;
        
        const result = await model.generateContent([systemPrompt, userQuery]);
        const text = result.response.text();
        return res.status(200).json({ text });
      }

      // --- Generación de Imágenes para Cuentos ---
      case 'storyImage': {
        const imagePrompt = `A whimsical and colorful children's book illustration of: ${params.character}, in ${params.setting}. The scene visually represents the value of ${params.value}. Cute, vibrant, heartwarming, storybook style, soft lighting.`;
        const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/imagen-3.0-generate-002:predict?key=${apiKey}`;
        
        const payload = { instances: [{ prompt: imagePrompt }], parameters: { "sampleCount": 1 } };
        
        const apiResponse = await fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (!apiResponse.ok) throw new Error(`Error en la API de Imagen: ${apiResponse.statusText}`);

        const result = await apiResponse.json();
        const base64Data = result.predictions?.[0]?.bytesBase64Encoded;

        if (base64Data) {
            return res.status(200).json({ imageUrl: `data:image/png;base64,${base64Data}` });
        } else {
            throw new Error("No se recibió una imagen válida de la API.");
        }
      }

      // --- Continuación de Cuentos ---
      case 'continueStory': {
        const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
        const systemPrompt = "Eres un escritor de cuentos infantiles. Continúa la siguiente historia de forma breve (unas 70-90 palabras), manteniendo el tono tierno y positivo. Añade un pequeño giro o un nuevo personaje amigo. Escribe en español.";
        const result = await model.generateContent([systemPrompt, params.story]);
        const text = result.response.text();
        return res.status(200).json({ text });
      }

      // --- Explicación de Valores ---
      case 'valueExplanation': {
        const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
        const systemPrompt = "Actúa como un educador infantil. Explícame en español qué es un valor de una forma muy sencilla y con un ejemplo claro, como si se lo contaras a un niño de 5 años. Tu respuesta debe ser cálida, fácil de entender y un poco más detallada. Usa entre 80 y 120 palabras.";
        const userQuery = `El valor es: "${params.value}".`;
        const result = await model.generateContent([systemPrompt, userQuery]);
        const text = result.response.text();
        return res.status(200).json({ text });
      }
        
      // --- Ideas para Jugar ---
      case 'playIdeas': {
        const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
        const systemPrompt = "Eres un pedagogo experto en juegos educativos. Dame 2 o 3 ideas de actividades o juegos muy sencillos para que padres e hijos hagan juntos en casa para practicar un valor. Usa un lenguaje cercano y explica cada juego en un párrafo corto. Formatea tu respuesta en HTML usando <ul> y <li> para la lista de juegos, y <strong> para los títulos de los juegos.";
        const userQuery = `El valor a practicar es: "${params.value}".`;
        const result = await model.generateContent([systemPrompt, userQuery]);
        const text = result.response.text();
        return res.status(200).json({ text });
      }
      
      // --- Generación de Audio (Texto a Voz) ---
       case 'tts': {
        const prompt = `Di con una voz dulce y amigable, como si contaras un cuento a un niño: ${params.text}`;
        const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-tts:generateContent?key=${apiKey}`;
        
        const payload = {
            contents: [{ parts: [{ text: prompt }] }],
            generationConfig: { responseModalities: ["AUDIO"] },
            model: "gemini-2.5-flash-preview-tts"
        };

        const apiResponse = await fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (!apiResponse.ok) throw new Error(`Error en la API TTS: ${apiResponse.statusText}`);
        
        const result = await apiResponse.json();
        const audioData = result.candidates?.[0]?.content?.parts?.[0]?.inlineData?.data;
        const mimeType = result.candidates?.[0]?.content?.parts?.[0]?.inlineData?.mimeType;

        if (audioData && mimeType) {
             return res.status(200).json({ audioData, mimeType });
        } else {
            throw new Error("Respuesta de audio inválida de la API.");
        }
       }

      default:
        return res.status(400).json({ error: 'Tipo de solicitud no válida' });
    }

  } catch (error) {
    // Capturamos cualquier error que ocurra durante el proceso
    console.error('Error en la función de Vercel:', error);
    return res.status(500).json({ error: error.message || 'Error en el servidor al procesar la solicitud.' });
  }
}

