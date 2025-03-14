<?php
if(isset($_GET['file'])){
    $old_name = './uploads/' . $_GET['file'];
    $parent_dir = isset($_GET['dir']) ? $_GET['dir'] : '';

    if(isset($_POST['new_name'])){
        $new_name = './uploads/'.$_POST['new_name'];
        if(rename($old_name, $new_name)){
            $redirect_url = 'index.php'.($parent_dir ? '?dir='.$parent_dir : '');
            header("location:$redirect_url");
        }else{
        echo "rename attempt error";
    }
    }
}else{
    // echo "you don't have access";
    header("location: index.php");
    exit();
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
        <form action="" method="post">
            <input type="text" name="new_name" value="<?php echo htmlspecialchars($_GET['file']); ?>">
            <button type="submit">Rename</button>
        </form>
    </body>
</html>