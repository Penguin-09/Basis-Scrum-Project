<?php

// --- This file is used to connect all webpages to the database.
// --- Change these values if you need to log into a different acount then 'bit_academy'.

// set access data
$dbhost = 'localhost';
$dbname = 'Nexed2';
$dbuser = 'bit_academy';
$dbpass = 'bit_academy';
$charset = 'utf8mb4';

// DSN (Data Source Name)
$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => true,
];

// create a PDO instance
try {
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}