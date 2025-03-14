<?php
require './vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$dbhost=$_ENV['DATABASE_HOST'];
$dbuser=$_ENV['DATABASE_USER'];
$dbname=$_ENV['DATABASE_NAME'];
$dbpass=$_ENV['DATABASE_PASS'];

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: ". $mysqli->connect_error);
}

// echo "Connected successfully";


?>