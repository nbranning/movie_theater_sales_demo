<?php
$docRoot = $_SERVER['DOCUMENT_ROOT'];
require_once $docRoot . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($docRoot);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_DATABASE'];

$conn = new mysqli($host, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

