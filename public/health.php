<?php
// Health check endpoint for Docker and ngrok
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

echo json_encode([
    'status' => 'ok',
    'timestamp' => date('c'),
    'service' => 'Ecommerce API',
    'version' => '1.0.0'
]);