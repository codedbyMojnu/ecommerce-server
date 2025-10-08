<?php
// Test Railway database connection
putenv('DATABASE_URL=mysql://root:vZfoFPPbhNIAuwhozsqbpiaGXsxxSUBG@shortline.proxy.rlwy.net:22824/railway');

require_once __DIR__ . '/config/database-connection.php';

try {
    $pdo = get_pdo_connection();
    echo "Successfully connected to Railway database!\n";
    
    // Test query
    $stmt = $pdo->query("SELECT VERSION() as version");
    $result = $stmt->fetch();
    echo "Database version: " . $result['version'] . "\n";
    
} catch (PDOException $e) {
    echo "Failed to connect to Railway database: " . $e->getMessage() . "\n";
}