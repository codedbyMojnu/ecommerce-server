<?php
// ফাইল: routes/api.php

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProductController.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../models/Product.php';

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];


if ($request_uri === '/api/login' && $request_method === 'POST') {
    handle_login();
} elseif ($request_uri === '/api/products' && $request_method === 'GET') {
    list_all_products();
} elseif (preg_match('/^\/api\/products\/(\d+)$/', $request_uri, $matches) && $request_method === 'GET') {
    show_product_details($matches[1]);
} elseif ($request_uri === '/api/checkout' && $request_method === 'POST') {
    $user_data = authenticate_user();
    
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Validate input
    if (empty($input['items']) || !is_array($input['items'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Items are required and must be an array']);
        exit();
    }
    
    // Process cart items
    $total_amount = 0;
    $processed_items = [];
    
    foreach ($input['items'] as $item) {
        if (empty($item['product_id']) || empty($item['quantity']) || !is_numeric($item['quantity'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Each item must have product_id and quantity']);
            exit();
        }
        
        // Get product details
        $product = get_product_by_id($item['product_id']);
        if (!$product) {
            http_response_code(404);
            echo json_encode(['message' => 'Product not found: ' . $item['product_id']]);
            exit();
        }
        
        // Calculate item total
        $item_total = $product['price'] * $item['quantity'];
        $total_amount += $item_total;
        
        $processed_items[] = [
            'product_id' => $product['id'],
            'product_name' => $product['name'],
            'quantity' => $item['quantity'],
            'unit_price' => $product['price'],
            'item_total' => $item_total
        ];
    }
    
    // Return success response with order details
    http_response_code(200);
    echo json_encode([
        'message' => 'Checkout successful!',
        'user_id' => $user_data->id,
        'order_details' => [
            'items' => $processed_items,
            'total_amount' => $total_amount,
            'order_id' => uniqid('order_')
        ]
    ]);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Endpoint not found.']);
}