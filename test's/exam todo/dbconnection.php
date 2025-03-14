<?php

require("./vendor/autoload.php");

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$dbname = $_ENV['DBNAME'];
$dbhost = $_ENV['DBHOST'];
$dbuser = $_ENV['DBUSER'];
$dbpass =  $_ENV['DBPASS'];

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if($connection->connect_error){
    die("ERROR conection to the data base".$connection->connect_error);
}
?>