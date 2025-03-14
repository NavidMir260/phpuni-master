<?php
require("./dbconnection.php");
$todoname = "";
 //&& isset($_POST['add'])
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $todoname = $_POST['todoname'];
    //var_dump($todoname);
    $sqltodo = "INSERT INTO todolist (item_name) VALUE ('$todoname')";
    $connection->query($sqltodo);

    // $delete = $_POST['delete'];
    // $sqldelete = "DELETE FROM todolist WHERE id=$delete";
}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        todolist
    </title>
    <h1>todolist</h1>
</head>
<body>
    <form method="post">
        <input type="text" id="todoname" name="todoname">
        <button type="submit" id="add">add</button>
    </form>
    <ul>
        <?php while()?>
        <div>
            <span>
                <a href="?archived">📎</a>
                <a href="?delete" id="delete">🗑️</a>
                <a href="edit.php">✏️</a>
            </span>
        </div>
    </ul>
</body>
</html>