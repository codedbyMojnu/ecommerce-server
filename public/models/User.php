<?php

require_once __DIR__ . '/../config/database-connection.php';

function find_user_by_email($email)
{
    $pdo = get_pdo_connection();
    $sql = "SELECT id, name, email, password FROM users WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}