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
include '../../database.php'; 

// دریافت پست ها از دیتابیس

$stmt = $pdo->query("SELECT post_id,title,created_at FROM blog_posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// بررسی اینکه سشن استارت خورده از قبل یا نه 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// بررسی اینکه آیا پیامی داریم یا نه 
if(isset($_SESSION['message'])){
    echo '<div class="alert">'. htmlspecialchars($_SESSION['message']).'</div>';
    unset($_SESSION['message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }
        tr th {
            background-color: #eefdfd;
        }
        th, td{
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th{
            background-color: #f2f2f2;
            color: #333;
        }

        td{
           background-color: #f2f2f2;
        }

        tr:nth-child(even) td{
            background-color: #fdfdfd;
        }

        tr:hover{
            background-color: #f7ffeb;
        }
        
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-danger{
            background-color: red;
            color: white;
            border:none;
        }

        .btn-primary{
            background-color: green;
            color: white;
            border:none;
        }

        .btn:hover{
            opacity: 0.8;
        }

        .action-btns{
            display: flex;
            gap:10px;
        }
        .btn-warning{
            background-color: orange;
            color: white;
            border:none;
        }

    </style>
</head>
<body>
    <!-- sidebar -->
     <?php include 'sidebar.php'; ?>

     <div class="main-content">
            <h1>Blog</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Post id</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($post['post_id']); ?></td>
                                <td><?php echo htmlspecialchars($post['title']);?></td>
                                <td><?php echo htmlspecialchars($post['created_at']); ?></td>
                                <!-- دکمه های ویرایش و حذف -->
                                <td>
                                     <a href="edit_post.php?post_id=<?php echo $post['post_id'];?>" class="btn btn-warning">Edit</a>
                                     <a href="../controllers/delete_post.php?post_id=<?php echo $post['post_id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
     </div>
</body>
</html>