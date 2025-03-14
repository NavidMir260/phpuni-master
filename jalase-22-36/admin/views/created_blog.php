<style>
    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: green;
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        animation: fadeIn 0.5s ease, fadeOut 0.5s ease;
    }
    @keyframes fadeIn {
        from{opacity:0; transform: translateY(20px);}
        to {opacity:1; transform: translateY(0px);}
        }

    @keyframes fadeOut {
        from{opacity:1; transform: translateY(0px);}
        to {opacity:0; transform: translateY(20px);}
    }
 
</style>
<?php 
include '../controllers/checklogin.php';
// include '../../database.php';

// بررسی اینکه سشن استارت خورده از قبل یا نه 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// بررسی اینکه آیا پیامی داریم یا نه 
if(isset($_SESSION['message'])){
    echo '<div class="alert">'. htmlspecialchars($_SESSION['message']).'</div>';
    unset($_SESSION['message']);
}

// بررسی اینکه کاربر از منو وارد شده است یا نه 
$is_from_menu = isset($_GET['from_menu']) && $_GET['from_menu'] == 'true';
$title = '';
$content = '';

// اگر از منو وارد شده بود سشن پاک بشه 
    if($is_from_menu){
        unset($_SESSION['title']);
        unset($_SESSION['content']);
    }else {
        $title = $_SESSION['title'] ?? '';
        $content = $_SESSION['content'] ?? '';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script  src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"> </script>
    <title>Add New Post</title>

</head>
<body>
     <!-- sidebar -->
     <?php include 'sidebar.php'; ?>

     <div class="main-content">

        <h1>Add New Post</h1>
        <form action="../controllers/save_post.php" method="POST">
            <label for="title">Blog Editor</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required> <br>
            <textarea name="blogContent" id="blogEditor"><?php echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); ?></textarea> </br>

            <button type="sumbit">Save Blog</button>
        </form>
     </div>
     <script>
        CKEDITOR.replace('blogEditor', {
            height:500,
            toolbar:[
                {name:'Clipboard',items:['cut','copy','paste','undo','redo']},
                {name:'Basicstyles',items:['Bold','Italic','Underline','Strike','-','RemoveFormat']},
                {name:'Paragraph',items:['NumberedList','BulletedList']},
                {name:'Link',items:['Link','Unlink']},
                {name:'Insert',items:['Image','Table','HorizontalRule','SpecialChar']},
                {name:'Tools',items:['Maximize']},
                {name:'document',items:['Source','Preview']}
            ],
            removePlugins: 'elementspath',
            resize_enabled:true,
        });
     </script>
</body>
</html>
