<?php 
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include '../../database.php';


try{
    // دریافت مقادیر فرم از created_blog.php 
    $title = $_POST['title'] ?? '';
    $content = $_POST['blogContent'] ?? '';
    $user_id = $_SESSION['user_id'] ?? '';


    // بررسی خالی بودن محتوا یا عنوان که اجازه اجرا در سمت دیتا بیس را ندهد
    if (empty($title) || empty($content)){
        throw new Exception ('عنوان یا محتوای بلاگ تمی تواند خالی باشد');
    }

    $stmt = $pdo->prepare("SELECT post_id FROM blog_posts WHERE title = :title AND user_id = :user_id");
    $stmt->execute(['title'=>$title, 'user_id'=>$user_id]);
    $existing_post = $stmt->fetch(PDO::FETCH_ASSOC);

    if($existing_post){
        // Update the post
        $stmt = $pdo->prepare("UPDATE blog_posts SET content = :content WHERE post_id = :post_id");
        $stmt->execute(['content'=>$content, 'post_id'=>$existing_post['post_id']]);

        $_SESSION['message'] = "پست با عنوان $title .بروز رسانی شد";

    }else{
        // Insert post
        $stmt = $pdo->prepare("INSERT INTO blog_posts (title, content, user_id) VALUES (:title, :content, :user_id)");
        $stmt->execute(['title'=>$title, 'content'=>$content, 'user_id'=>$user_id]);

        $_SESSION['message'] = "پست جدید با عنوان $title ایجاد شد.";
    }

    // ذخیره اطلاعات در سشن برای نمایش مجدد به کاربر در فرم
    $_SESSION['title'] = $title;
    $_SESSION['content'] = $content;

    header('Location: ../views/created_blog.php');
    exit();

} catch (\Exception $e) {
    $_SESSION['message'] = 'خطا در ذخیره پلاگ پست' . $e->getMessage();
    header('Location:../views/created_blog.php');
    exit();
}


?>
