<?php



session_start();

$resultMessage = "";

// بررسی طرز دریافت به که صورت پست باشد
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // اتصال به دیتا بیس
    $mysqli = require './connection.php';

    $exam_title = $_POST["exam_title"];

    // برای یافتن آزمون
    $find_Exam_Query = $mysqli->prepare("SELECT Exam.exam_id, Exam.title, Users.first_name, Users.last_name 
                              FROM Exam 
                              JOIN Users ON Exam.teacher_id = Users.user_id 
                              WHERE Exam.title = ?");
    $find_Exam_Query->bind_param("s", $exam_title);
    $find_Exam_Query->execute();
    $find_Exam_Query->store_result();

    // اگر امتحانی پیدا شد اون رو نمایش بده
    if ($find_Exam_Query->num_rows > 0) {
        $find_Exam_Query->bind_result($exam_id, $title, $teacher_first_name, $teacher_last_name);


        $outputBuffer = "";



        while ($find_Exam_Query->fetch()) {
            $outputBuffer .= "<h3>Exam Found:</h3>";
            $outputBuffer .= "<p>Title: " . htmlspecialchars($title, ENT_QUOTES) . "</p>";
            $outputBuffer .= "<p>Teacher: " . htmlspecialchars($teacher_first_name, ENT_QUOTES) . " " . htmlspecialchars($teacher_last_name, ENT_QUOTES) . "</p>";
            $outputBuffer .= "<form action='take_exam.php' method='post'>";
            $outputBuffer .= "<input type='hidden' name='exam_id' value='" . htmlspecialchars($exam_id, ENT_QUOTES) . "'>";
            $outputBuffer .= "<input type='submit' value='Take Exam'>";
            $outputBuffer .= "</form>";
        }
        $resultMessage = $outputBuffer;
    } else {
        //   ارور اگر هیچ امتحانی با نام (کد) امتحان پیدا نشد
        $resultMessage = "No exam found with this title.";
    }



    $find_Exam_Query->close();
    $mysqli->close();
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Student Control Panel</title>
    <link rel="stylesheet" href="styl/web_styl.css">
</head>
<body>
    <h2>Student Control Panel</h2>

    <form action="student_controlpanel.php" method="post">
        <label for="exam_title">Exam Title:</label>
        <input type="text" id="exam_title" name="exam_title" required><br><br>
        <input type="submit" value="Find Exam">
    </form>

    <?php
        echo $resultMessage;
    ?>


</body>
</html>

