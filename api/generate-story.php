<?php
/**
 * api/generate.php
 *
 * Backend seguro en PHP para gestionar todas las llamadas a la API de Gemini.
 * Este archivo actúa como un intermediario que recibe peticiones del frontend,
 * añade la clave secreta de la API y se comunica de forma segura con los servidores de Google.
 */

// --- CONFIGURACIÓN DE SEGURIDAD ---

// 1. Dominio permitido (CORS)
// ¡IMPORTANTE! Cambia "https://obesitalasirenita.es" por el dominio exacto donde está alojada tu página.
// Si estás probando en local, puedes usar "*" temporalmente, pero ¡NUNCA en producción!
header("Access-Control-Allow-Origin: https://obesitalasirenita.es");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Responde a las solicitudes de pre-vuelo (preflight) de los navegadores
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 2. Clave de API de Gemini
// ¡CRÍTICO! Reemplaza el texto de abajo con tu clave de API real.
// La forma más segura es usar variables de entorno del servidor, pero para empezar, puedes ponerla aquí.
// ¡NO compartas este archivo públicamente si tu clave está aquí!
define('GEMINI_API_KEY', 'AIzaSyDv30B3iQ5iHaRnyXTFCtogJ2LdULCi1E0');


// --- FUNCIÓN CENTRAL PARA LLAMADAS A LA API ---

/**
 * Realiza una llamada cURL a una URL de la API de Google.
 * @param string $apiUrl La URL completa del endpoint de la API.
 * @param array $payload El cuerpo de la solicitud en formato de array PHP.
 * @return array Los datos de la respuesta decodificados.
 * @throws Exception Si la llamada a la API falla.
 */
function callGoogleApi(string $apiUrl, array $payload): array {
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_TIMEOUT, 90); // Aumentar el tiempo de espera para la generación de imágenes

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) {
        throw new Exception('Error de cURL: ' . $curl_error);
    }
    
    $responseData = json_decode($response, true);

    if ($http_code !== 200) {
        $errorMessage = 'Error en la API de Google.';
        if (isset($responseData['error']['message'])) {
            $errorMessage = $responseData['error']['message'];
        }
        throw new Exception("Error HTTP {$http_code}: {$errorMessage}");
    }

    return $responseData;
}


// --- LÓGICA PARA CADA TIPO DE PETICIÓN ---

// Las siguientes funciones preparan el 'prompt' y el 'payload' para cada tarea específica.

function generateStoryText(array $params): array {
    $systemPrompt = "Eres un escritor experto en cuentos infantiles para niños de 4 a 8 años. Tu estilo es tierno, positivo y visual. Escribe en español un cuento muy corto (entre 100 y 150 palabras) que tenga un final feliz y que enseñe un valor de forma clara y sencilla. El cuento debe ser fácil de leer en voz alta. Usa los elementos que te proporcionará el usuario.";
    $userQuery = "El personaje principal es {$params['character']}. El valor a enseñar es {$params['value']}. El cuento sucede en {$params['setting']}.";
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . GEMINI_API_KEY;
    $payload = [
        'contents' => [['parts' => [['text' => $userQuery]]]],
        'systemInstruction' => ['parts' => [['text' => $systemPrompt]]],
    ];
    $result = callGoogleApi($apiUrl, $payload);
    $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
    if (!$text) throw new Exception('No se pudo generar el texto del cuento.');
    return ['text' => $text];
}

function generateStoryImage(array $params): array {
    $imagePrompt = "A whimsical and colorful children's book illustration of: {$params['character']}, in {$params['setting']}. The scene visually represents the value of {$params['value']}. Cute, vibrant, heartwarming, storybook style, soft lighting.";
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/imagen-3.0-generate-002:predict?key=' . GEMINI_API_KEY;
    $payload = [
        'instances' => [['prompt' => $imagePrompt]],
        'parameters' => ['sampleCount' => 1]
    ];
    $result = callGoogleApi($apiUrl, $payload);
    $base64Data = $result['predictions'][0]['bytesBase64Encoded'] ?? null;
    if (!$base64Data) throw new Exception('No se recibió una imagen válida.');
    return ['imageUrl' => 'data:image/png;base64,' . $base64Data];
}

function generateTTS(array $params): array {
    $prompt = "Di con una voz dulce y amigable, como si contaras un cuento a un niño: {$params['text']}";
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-tts:generateContent?key=' . GEMINI_API_KEY;
    $payload = [
        'contents' => [['parts' => [['text' => $prompt]]]],
        'generationConfig' => ['responseModalities' => ['AUDIO']],
        'model' => 'gemini-2.5-flash-preview-tts'
    ];
    $result = callGoogleApi($apiUrl, $payload);
    $audioData = $result['candidates'][0]['content']['parts'][0]['inlineData']['data'] ?? null;
    $mimeType = $result['candidates'][0]['content']['parts'][0]['inlineData']['mimeType'] ?? null;
    if (!$audioData || !$mimeType) throw new Exception('Respuesta de audio inválida.');
    return ['audioData' => $audioData, 'mimeType' => $mimeType];
}

function generateValueExplanation(array $params): array {
    $systemPrompt = "Actúa como un educador infantil. Explícame en español qué es un valor de una forma muy sencilla y con un ejemplo claro, como si se lo contaras a un niño de 5 años. Tu respuesta debe ser cálida, fácil de entender y un poco más detallada. Usa entre 80 y 120 palabras.";
    $userQuery = "El valor es: \"{$params['value']}\".";
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . GEMINI_API_KEY;
    $payload = [
        'contents' => [['parts' => [['text' => $userQuery]]]],
        'systemInstruction' => ['parts' => [['text' => $systemPrompt]]],
    ];
    $result = callGoogleApi($apiUrl, $payload);
    $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
    if (!$text) throw new Exception('No se pudo generar la explicación.');
    return ['text' => $text];
}

function generateContinuedStory(array $params): array {
    $systemPrompt = "Eres un escritor de cuentos infantiles. Continúa la siguiente historia en español de forma breve (un párrafo, 50-70 palabras), manteniendo el tono tierno y positivo del inicio. Crea un pequeño giro o una nueva acción para los personajes.";
    $userQuery = "Continúa esta historia: \"{$params['story']}\"";
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . GEMINI_API_KEY;
    $payload = [
        'contents' => [['parts' => [['text' => $userQuery]]]],
        'systemInstruction' => ['parts' => [['text' => $systemPrompt]]],
    ];
    $result = callGoogleApi($apiUrl, $payload);
    $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
    if (!$text) throw new Exception('No se pudo continuar la historia.');
    return ['text' => $text];
}

function generatePlayIdeas(array $params): array {
    $systemPrompt = "Eres un pedagogo infantil. Para el valor proporcionado, sugiere 2 actividades o juegos muy simples que un padre pueda hacer con un niño de 5 años. Responde en español. Formatea la respuesta como una lista HTML no ordenada (`<ul>`). Cada `<li>` debe empezar con un emoji relacionado. Sé práctico, directo y usa un lenguaje cercano y amigable.";
    $userQuery = "El valor es: \"{$params['value']}\".";
    $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . GEMINI_API_KEY;
    $payload = [
        'contents' => [['parts' => [['text' => $userQuery]]]],
        'systemInstruction' => ['parts' => [['text' => $systemPrompt]]],
    ];
    $result = callGoogleApi($apiUrl, $payload);
    $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
    if (!$text) throw new Exception('No se pudieron generar ideas de juego.');
    return ['text' => $text];
}


// --- PUNTO DE ENTRADA PRINCIPAL (ROUTER) ---

header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('JSON inválido en la solicitud.');
    }

    $type = $input['type'] ?? null;
    if (empty($type)) {
        throw new Exception('Falta el "type" en la solicitud.');
    }

    $response_data = [];
    switch ($type) {
        case 'storyText':
            $response_data = generateStoryText($input);
            break;
        case 'storyImage':
            $response_data = generateStoryImage($input);
            break;
        case 'tts':
            $response_data = generateTTS($input);
            break;
        case 'valueExplanation':
            $response_data = generateValueExplanation($input);
            break;
        case 'continueStory':
            $response_data = generateContinuedStory($input);
            break;
        case 'playIdeas':
            $response_data = generatePlayIdeas($input);
            break;
        default:
            throw new Exception("Tipo de solicitud no válido: {$type}");
    }

    http_response_code(200);
    echo json_encode($response_data);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

exit();
