<?php
// ফাইল: controllers/ProductController.php

require_once __DIR__ . '/../models/Product.php';

function list_all_products()
{
    $products = get_all_products();
    http_response_code(200); // 200 মানে সফল বা OK
    echo json_encode($products);
}

function show_product_details($id)
{
    $product = get_product_by_id($id);

    if ($product) {
        http_response_code(200);
        echo json_encode($product);
    } else {
        http_response_code(404); // 404 মানে খুঁজে পাওয়া যায়নি
        echo json_encode(['message' => 'Product not found.']);
    }
}
