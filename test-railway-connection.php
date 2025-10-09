<?php
// Test script to verify Railway MySQL database connection
require_once __DIR__ . '/config/database-connection.php';

echo "Testing Railway MySQL database connection...\n";

try {
    $connection = get_pdo_connection();
    echo "✅ Successfully connected to the database!\n";
    
    // Test a simple query
    $stmt = $connection->query("SELECT VERSION() as version");
    $result = $stmt->fetch();
    echo "MySQL Version: " . $result['version'] . "\n";
    
    // Test if products table exists
    $stmt = $connection->query("SHOW TABLES LIKE 'products'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Products table exists\n";
    } else {
        echo "⚠️  Products table not found\n";
    }
    
    // Test if users table exists
    $stmt = $connection->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Users table exists\n";
    } else {
        echo "⚠️  Users table not found\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "Database connection test completed.\n";