<?php
//  include 'checklogin.php';
// مشکل از این خط کد شماره 4 بود که سشن استارت نخورده بود 
session_start();
 require '../../database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];

   try {
    //code...
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    }else {
        echo json_encode(['success' => false]);
    }

   } catch (\PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
 
}
}else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

?>