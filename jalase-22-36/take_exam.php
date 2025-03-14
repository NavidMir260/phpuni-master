<?php
session_start();

$resultContent = "";

// بررسی طرز دریافت به که صورت پست باشد
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // اتصال به دیتا بیس
    $mysqli = require './connection.php';
    
    $exam_id   = $_POST["exam_id"];
    $student_id = $_SESSION["user_id"];

    // اتصال به دیتا بیس برای گرفتن سوال ها
    $getExamQuestions = $mysqli->prepare("SELECT question_id, content FROM Question WHERE exam_id = ?");
    $getExamQuestions->bind_param("i", $exam_id);
    $getExamQuestions->execute();
    $getExamQuestions->store_result();

    // بررسی اینکه سوالی پیدا شد و اگر سوال پیدا شد شروع به ساخت فرم میکند
    if ($getExamQuestions->num_rows > 0) {
        $getExamQuestions->bind_result($question_id, $content);
        

        ob_start();
        echo "<form action='submit_exam.php' method='post'>";
        // گذاشتن ایدی کاربر و امتحان به صورت پنهان برای امنیت بیشتر با type='hidden'
        echo "<input type='hidden' name='exam_id' value='" . htmlspecialchars($exam_id, ENT_QUOTES) . "'>";
        echo "<input type='hidden' name='student_id' value='" . htmlspecialchars($student_id, ENT_QUOTES) . "'>";
        

        while ($getExamQuestions->fetch()) {
            echo "<div class='question'>";
            echo "<h3>" . htmlspecialchars($content, ENT_QUOTES) . "</h3>";

            // دریافت گزینه های پاسخ برای هر سوال
            $getAnswersQuery = $mysqli->prepare("SELECT answer_option, answer_text FROM Answer WHERE question_id = ? ORDER BY answer_option ASC");
            $getAnswersQuery->bind_param("i", $question_id);
            $getAnswersQuery->execute();
            $result_answers = $getAnswersQuery->get_result();
            
            // پاسخ درست
            while ($row = $result_answers->fetch_assoc()) {
                $option = $row['answer_option'];
                $text   = htmlspecialchars($row['answer_text'], ENT_QUOTES);
                echo "<label>$option: <input type='radio' name='answers[$question_id]' value='$option' required> $text</label><br>";
            }
            $getAnswersQuery->close();

            echo "</div>";
        }
        echo "<input type='submit' value='Submit Exam'>";
        echo "</form>";

        $resultContent = ob_get_clean();



    } else {
        $resultContent = "No questions found for this exam.";
    }
    $getExamQuestions->close();
    $mysqli->close();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Take Exam</title>
    <link rel="stylesheet" href="styl/web_styl.css">
</head>
<body>
    <h2>Take Exam</h2>


    <?php
        echo $resultContent;
    ?>
    
</body>
</html>
