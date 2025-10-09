<?php
// ফাইল: middleware/AuthMiddleware.php

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticate_user()
{
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

    if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        http_response_code(401); // 401 মানে Unauthorized
        echo json_encode(['message' => 'Authorization token not found or invalid format.']);
        exit();
    }
    $jwt = $matches[1];
    $secret_key = "arafat-bhai";

    try {
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
        return $decoded->data;
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['message' => 'Access denied. Invalid or expired token.']);
        exit();
    }
}
