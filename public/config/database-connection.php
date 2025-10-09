<?php
// Load environment variables
require_once __DIR__ . '/dotenv.php';
load_env();

function get_pdo_connection()
{
    // Check if we're in production environment
    $database_url = getenv('DATABASE_URL');
    
    if (!empty($database_url)) {
        // Production environment (Railway)
        // Parse the DATABASE_URL
        $url = parse_url($database_url);
        
        $host = $url['host'];
        $port = $url['port'];
        $dbname = substr($url['path'], 1); // Remove the leading '/'
        $username = $url['user'];
        $password = $url['pass'];
    } else {
        // Development environment (DBngin)
        $host = '127.0.0.1';
        $port = '3307'; // DBngin port
        $dbname = 'ecommerce';
        $username = 'root';
        $password = '';
    }
    
    $charset = 'utf8mb4';

    // Data Source Name
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        return $connection;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['message' => 'Database Connection Failed: ' . $e->getMessage()]);
        exit();
    }
}