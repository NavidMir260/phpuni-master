<?php 
include './checklogin.php';
include '../../database.php';

// دریافت پست آی دی با متد گت
$post_id = $_GET['post_id'] ?? '';

if($post_id){
    // حذف پست از دیتابیس
    $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE post_id = :post_id");
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();

    // نمایش پیام حذف با موفقیت
    $_SESSION['message'] = "پست یا بلاگ مورد نظر با موفقیت حذف شد.";
}else {
    // نمایش پیام خطا
    $_SESSION['message'] = "پست یا بلاگ مورد نظر یافت نشد.";
}

// بازگشت به صفحه بلاگ 
    header('Location:../views/blog.php');
    exit();

?>