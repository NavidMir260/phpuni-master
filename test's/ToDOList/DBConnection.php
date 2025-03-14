<?php

require "./vendor/autoload.php";

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbhost = $_ENV['HOSTNAME'];
$dbusername = $_ENV['USERNAME'];
$dbpass = $_ENV['DBPASS'];
$dbname = $_ENV['DBNAME'];

?>