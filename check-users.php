<?php
require_once __DIR__ . '/config/database-connection.php';

try {
    $pdo = get_pdo_connection();
    
    // Get all users
    $stmt = $pdo->query("SELECT id, name, email, password FROM users");
    $users = $stmt->fetchAll();
    
    echo "Users in database:\n";
    foreach ($users as $user) {
        echo "ID: " . $user['id'] . "\n";
        echo "Name: " . $user['name'] . "\n";
        echo "Email: " . $user['email'] . "\n";
        echo "Password hash: " . $user['password'] . "\n";
        echo "Password verify for 'password123': " . (password_verify('password123', $user['password']) ? 'Valid' : 'Invalid') . "\n";
        echo "------------------------\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}