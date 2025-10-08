<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/User.php';

use Firebase\JWT\JWT;

function handle_login()
{
    $input = json_decode(file_get_contents('php://input'), true);
    if (empty($input['email']) || empty($input['password'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Email and Password are required']);
        return;
    }
    $user = find_user_by_email($input['email']);
    if ($user && password_verify($input['password'], $user['password'])) {
        $secret_key = "arafat-bhai"; // এটি খুব গোপন রাখতে হবে!
        $payload = [
            'iss' => "http://localhost", // Issuer
            'aud' => "http://localhost", // Audience
            'iat' => time(), // Issued at
            'exp' => time() + 3600, // Expiration time (1 hour)
            'data' => [
                'id' => $user['id'],
                'email' => $user['email']
            ]
        ];
        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        http_response_code(200);
        echo json_encode(['token' => $jwt]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Invalid credentials.']);
    }
}