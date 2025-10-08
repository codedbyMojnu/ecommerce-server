<?php
require_once __DIR__ . '/config/database-connection.php';

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
    echo "Users table created successfully.\n";
    
    // Create products table
    $sql_products = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql_products);
    echo "Products table created successfully.\n";
    
    // Check if we already have products
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products");
    $result = $stmt->fetch();
    
    if ($result['count'] == 0) {
        // Insert sample data into products table
        $sql_insert_products = "INSERT INTO products (name, description, price) VALUES 
            ('Premium Laptop', 'High performance laptop with 16GB RAM', 1200.50),
            ('Wireless Mouse', 'Ergonomic wireless mouse', 25.00),
            ('Headphones', 'Noise cancelling headphones', 199.99)";
        
        $pdo->exec($sql_insert_products);
        echo "Sample products inserted successfully.\n";
    } else {
        echo "Products already exist in the database.\n";
    }
    
    // Check if we already have users
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users WHERE email = 'john@example.com'");
    $result = $stmt->fetch();
    
    if ($result['count'] == 0) {
        // Insert a sample user (password is 'password123' hashed)
        $password_hash = password_hash('password123', PASSWORD_DEFAULT);
        $sql_insert_user = "INSERT INTO users (name, email, password) VALUES 
            ('John Doe', 'john@example.com', '$password_hash')";
        
        $pdo->exec($sql_insert_user);
        echo "Sample user inserted successfully.\n";
    } else {
        echo "Sample user already exists in the database.\n";
    }
    
    echo "Database setup completed successfully!\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}