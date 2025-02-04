<?php

// --- This file is used to connect all webpages to the database.
// --- Change these values if you need to log into a different acount then 'bit_academy'.

// Constants for database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'Rhizome');
define('DB_USER', 'bit_academy');
define('DB_PASS', 'bit_academy');
define('DB_CHARSET', 'utf8mb4');

$dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s",
    DB_HOST,
    DB_NAME,
    DB_CHARSET
);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die('Database connection failed. Please try again later.');
}

?>