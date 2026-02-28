<?php
$host = 'localhost';
$db   = 'contact_manager';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // create table if it doesn't exist
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS contacts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
