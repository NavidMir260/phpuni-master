<?php 
// شروع سشن در صورتی که استارت نخورده بود
if(session_start() === PHP_SESSION_NONE){
    session_start();
}

// echo $_SERVER['HTTP_REFERER'];
// در صورتی که کاربر لاگین نشده بود پروسس لغو میشود و دسترسی به پنل امکان پذیر نیست
if(!isset($_SESSION['user_id']) && $_SERVER['HTTP_REFERER'] !== 'http://phpuni.com/jalase-22-30/login.php') {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    // چون کاربر لاگین نشده است به صفحه لاگین هدایت شود
    header('location: ../../login.php');
    exit();
}

?>