<?php

require_once __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../../.env');
$dotenv->load();

$dbServerName = $_ENV['DB_SERVER_NAME'];
$dbName = $_ENV['DB_NAME'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];

$connection = new PDO('mysql:host=' . $dbServerName . ';dbname=' . $dbName . '', $dbUsername, $dbPassword);
