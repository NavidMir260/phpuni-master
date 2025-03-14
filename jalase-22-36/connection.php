<?php
$envPath = __DIR__ . '/.env';
if (!file_exists($envPath)) {
    die('.env file not found');
}

$env = parse_ini_file($envPath);

$dbHost = isset($env['DB_HOST']) ? $env['DB_HOST'] : 'localhost';
$dbUser = isset($env['DB_USER']) ? $env['DB_USER'] : 'root';
$dbPass = isset($env['DB_PASS']) ? $env['DB_PASS'] : '';
$dbName = isset($env['DB_NAME']) ? $env['DB_NAME'] : 'exam3';

$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

return $mysqli;
?>
