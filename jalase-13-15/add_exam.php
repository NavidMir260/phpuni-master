<?php

$title_err = "";
$createExamForm = "";

// بررسی طرز دریافت به صورت پوست
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // اتصال به دیتابیس
    $mysqli = require './connection.php';
    


    $title = $_POST["title"];
    $num_questions = $_POST["num_questions"];

    // بررسی اینکه ایا اسم امتحان (کد امتحان) قبلا ثبت شده یا نه
    $title_checker = $mysqli->prepare("SELECT title FROM Exam WHERE title = ?");
    $title_checker->bind_param("s", $title); // "s" means the parameter is a string.
    $title_checker->execute();
    $title_checker->store_result();

    // اگر داده ای بود با ایف نمیذلارد داده ثبت بشود و با الس اگه داده نبود اون اسم یا کد رو ثبت میکند
    if ($title_checker->num_rows > 0) {
        $title_err = "An exam with this title already exists. Please choose a different title.";
    } else {
        $createExamForm  = "<form action='create_exam.php' method='post'>";

        $createExamForm .= "<input type='hidden' name='title' value='" . htmlspecialchars($title, ENT_QUOTES) . "'>";
        $createExamForm .= "<input type='hidden' name='num_questions' value='" . htmlspecialchars($num_questions, ENT_QUOTES) . "'>";
        $createExamForm .= "<input type='submit' value='Next'>";

        $createExamForm .= "</form>";
    }

    $title_checker->close();
    $mysqli->close();



}




?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Exam</title>
    <!-- دسترسی به فایل استایل -->
    <link rel="stylesheet" href="styl/web_styl.css">
</head>
<body>
    <div class="container">
        <h2>Add Exam</h2>
        <!-- دریافت اطلاعات امتحان (بدون سوال ها) و ثبت -->
        <form action="add_exam.php" method="post">
            <label for="title">Exam Title:</label>
            <input type="text" id="title" name="title" required>
            <br><br>
            <label for="num_questions">Number of Questions:</label>
            <input type="number" id="num_questions" name="num_questions" min="1" required>
            <br><br>
            <input type="submit" value="Next">
        </form>

        <?php
        //  اگر نام امتحان(کد) قبلا استفاده شده بود ارور رو نشون بده(که تایتل ارور را از بالا تو بخش ایف گرفتیم)
        if (!empty($title_err)) {
            echo "<p>" . $title_err . "</p>";
        }
        // انتقال اگر اروری وجود نداشت
        if (!empty($createExamForm)) {
            echo $createExamForm;
        }
        ?>
    </div>
</body>
</html>
