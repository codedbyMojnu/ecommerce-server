<?php
// ফাইল: models/Product.php

require_once __DIR__ . '/../config/database-connection.php';


function get_all_products()
{
    $pdo = get_pdo_connection();
    $stmt = $pdo->query("SELECT id, name, price FROM products ORDER BY id DESC");
    return $stmt->fetchAll();
}

function get_product_by_id($id)
{
    $pdo = get_pdo_connection();
    $sql = "SELECT id, name, description, price FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}
