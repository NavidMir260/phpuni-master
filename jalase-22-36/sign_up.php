<?php

session_start();

$message = "";

// بررسی طرز دریافت به که صورت پست باشد

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // اتصال به دیتا بیس
    $mysqli = require './connection.php';

    $first_name = $_POST["first_name"];
    $last_name  = $_POST["last_name"];
    $email      = $_POST["email"];
    // پسورد هش به ما کمک میکند که رمزه استفاده شده در امنیت بیشتری بماند
    $password   = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role       = $_POST["role"];

    // بررسی اینکه ایمییل داده شده از قبل وجود داشته یا نه
    $checkEmail = $mysqli->prepare("SELECT email FROM Users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

        // اگر ایمیل از قبل وجود داشت ارور بده و اگر وجود نداشت اون رو تو دیتابیس بسازه
    if ($checkEmail->num_rows > 0) {

        $message = "The email address is already registered. Please use a different email.";
    } else {
        $sql = "INSERT INTO Users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $Insert_User_Record = $mysqli->prepare($sql);
        $Insert_User_Record->bind_param("sssss", $first_name, $last_name, $email, $password, $role);

        if ($Insert_User_Record->execute()) {
            $message = "Sign up successful!";
        } else {
            $message = "Error: " . $Insert_User_Record->error;
        }

        $Insert_User_Record->close();
    }

    $checkEmail->close();
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="styl/web_styl.css">
</head>
<body>
    <h2>Sign Up</h2>
    

    <?php 
    //  برای نشون دادن ارور که از بالا گرفدتش
    if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>


    
    <form action="sign_up.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select><br><br>
        
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
