<?php

require_once __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../../.env');
$dotenv->load();

$dbServerName = $_ENV['DB_SERVER_NAME'];
$dbName = $_ENV['DB_NAME'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];

// Create connection
$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
