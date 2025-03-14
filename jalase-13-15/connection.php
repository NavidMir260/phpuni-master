<?php 

$mysqli = new mysqli('localhost', 'root', '', 'exam3');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

return $mysqli;

?>
