<?php
/**
 * Production deployment script
 * This script sets up the database for production environment
 */

require_once __DIR__ . '/config/database-connection.php';

echo "Setting up database for production...\n";

try {
    $pdo = get_pdo_connection();
    
    // Create users table
    $sql_users = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql_users);
    echo "Users table created/verified successfully.\n";
    
    // Create products table
    $sql_products = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql_products);
    echo "Products table created/verified successfully.\n";
    
    echo "Production database setup completed successfully!\n";
    echo "Note: No sample data was inserted for production.\n";
    echo "Please add your production data manually or through your admin interface.\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}