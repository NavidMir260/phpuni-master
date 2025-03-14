<?php
if(isset($_GET['file'])){
    $file = './uploads/'.$_GET['file'];
    $current_dir = dirname($_GET['file']);
    if(isset($_POST['content'])){
        file_put_contents($file, $_POST['content']);
        header("location: index.php?dir=".urlencode($current_dir));
        exit();
    }
    $content = file_get_contents($file);
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=devic-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/style.css">
    </head>
    <body>
        <h1>view and edit file</h1>
        <form action="" method="post">
            <textarea name="content" rows="20" cols="100%">
                <?php echo htmlspecialchars($content); ?> 
            </textarea> <br>
            <button type="submit">Save</button>
        </form>
    </body>
</html>

<?php 






?>
