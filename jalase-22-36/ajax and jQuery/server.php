<?php 

$data = [
    "message" => "سلام این داده ها از سمت سرور دریافت شده است",
    "time" => date("H:i:s")
];

header('Content-Type: application/json');
echo json_encode($data);

?>