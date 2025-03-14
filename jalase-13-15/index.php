<?php

session_start();



$errorMessage = "";

// بررسی طرز دریافت به صورت پست
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // اتصال به دیتا بیس
    $mysqli = require './connection.php';

    // خواندن داده
    $email = $_POST["email"];
    $password = $_POST["password"];

    // جستوجوی کاربر (براساس ایمیل)
    $userLookup = $mysqli->prepare("SELECT user_id, password, role FROM Users WHERE email = ?");
    $userLookup->bind_param("s", $email);
    $userLookup->execute();
    $userLookup->store_result();

    // اگر کابر پیدا شد بقیه اطلاعات چک شود
    if ($userLookup->num_rows > 0) {
        $userLookup->bind_result($user_id, $hashed_password, $role);
        $userLookup->fetch();

        // بررسی رمز عبور کابر
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["role"] = $role;

            // انتقال کاربر براساس دانشجو یا استاد بودن
            if ($role == "student") {
                header("Location: student_controlpanel.php");
                exit();
            } elseif ($role == "teacher") {
                header("Location: teacher_controlpanel.php");
                exit();
            }
        } else {
            // ارور اگر رمزش غلط بود
            $errorMessage = "Incorrect password. Please try again.";
        }
    } else {
        // ارور اگر ایمیلی که داده بود موجود نبود تو دیتا بیس
        $errorMessage = "No account found with this email. Please sign up first.";
    }


    $userLookup->close();
    $mysqli->close();
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="styl/web_styl.css">
    <style>
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
        }

        form {
            margin: 0;
        }

        .signup-container {
            margin-top: 20px;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Sign In</h2>
    
    <?php if (!empty($errorMessage)) : ?>
        <p class="error-message"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <div class="form-container">
        <!-- این برای ساین این -->
        <form action="index.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
    
            <input type="submit" value="Sign In">
        </form>

        <!-- این برای ساین آپ -->
        <div class="signup-container">
            <p>If you don't have an account, create one by signing up</p>
            <form action="sign_up.php" method="get">
                <input type="submit" value="Sign Up">
            </form>
        </div>
    </div>
</body>
</html>
