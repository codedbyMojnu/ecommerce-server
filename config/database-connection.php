<?php
function get_pdo_connection()
{
    $host = '127.0.0.1';
    $port = '3307'; // DBngin port
    $dbname = 'ecommerce';
    $username = 'root';
    $password = '';
    $charset = 'utf8mb4';

    // Data Source name === কোন ডাটাবেসে কিভাবে সংযোগ দিতে হয়ে?
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

    // VAI ER KACE BUJHE NIBO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        // return connection object
        return $connection;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['message' => 'Database Connection Failed: ' . $e->getMessage()]);
        exit();
    }
}