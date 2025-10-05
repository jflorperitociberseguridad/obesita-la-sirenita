<?php
// api/generate-story.php - Backend seguro para la API de Gemini

// --- CONFIGURACIÓN DE SEGURIDAD ---

// 1. Permite solicitudes CORS solo desde tu dominio (¡Cambia el dominio!)
header("Access-Control-Allow-Origin: https://obesitalasirenita.es");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Maneja las solicitudes preflight OPTIONS (necesarias para CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 2. Definición de la Clave de API (¡CRÍTICO! Mantenla oculta)
// La forma más segura es obtenerla de una variable de entorno, pero por simplicidad,
// la pondremos aquí. ¡RECUERDA NUNCA COMPARTIR ESTE ARCHIVO!
//
// ⚠️ REEMPLAZA "TU_CLAVE_SECRETA_DE_GEMINI_AQUI" con tu clave real.
$api_key = "TU_CLAVE_SECRETA_DE_GEMINI_AQUI"; 
$api_url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $api_key;


// --- PROCESAMIENTO DE LA SOLICITUD ---

header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

// Obtener el cuerpo JSON de la solicitud (enviado desde el fetch de JavaScript)
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

$prompt = $data['prompt'] ?? null;

if (empty($prompt)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Falta el prompt en la solicitud.']);
    exit();
}

// --- LLAMADA A LA API DE GEMINI ---

$payload = [
    'contents' => [
        [
            'parts' => [
                ['text' => $prompt]
            ]
        ]
    ],
    'config' => [
        'temperature' => 0.8,
        'maxOutputTokens' => 200,
    ]
];

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$api_data = json_decode($response, true);

// --- ENVÍO DE RESPUESTA AL FRONTEND ---

if ($http_code !== 200 || !isset($api_data['candidates'][0]['content']['parts'][0]['text'])) {
    // Manejo de errores de la API o HTTP
    $error_message = 'Error en la llamada a la API.';
    if (isset($api_data['error']['message'])) {
        $error_message = $api_data['error']['message'];
    } elseif ($http_code !== 200) {
        $error_message = "Error HTTP: " . $http_code;
    }

    http_response_code(500);
    echo json_encode(['error' => 'No se pudo generar el cuento: ' . $error_message]);
    exit();
}

$generated_story = $api_data['candidates'][0]['content']['parts'][0]['text'];

// Éxito: devuelve el cuento al frontend
http_response_code(200);
echo json_encode(['story' => $generated_story]);
?>
