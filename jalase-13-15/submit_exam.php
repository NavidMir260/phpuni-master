<?php
session_start();

$resultMessage = "";

// بررسی طرز دریافت به که صورت پست باشد
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // اتصال به دیتا بیس
    $mysqli = require './connection.php';
    

    $exam_id   = $_POST["exam_id"];
    $student_id = $_POST["student_id"];
    $answers   = $_POST["answers"];
    
    $score = 0;
    $total_questions = count($answers);
    
    // بررسی هر پاسخ برای محاسبه نمره
    foreach ($answers as $question_id => $answer) {
        $stmt = $mysqli->prepare("SELECT is_correct FROM Answer WHERE question_id = ? AND answer_option = ?");
        $stmt->bind_param("is", $question_id, $answer);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($is_correct);
        
        //   اگر جواب وجود داشت و جواب درست بود نمره بگیره
        if ($stmt->fetch() && $is_correct) {
            $score++;
        }
        $stmt->close();
    }
    
    // بررسی نمره نهایی برحسب درصد
    $final_score = ($total_questions > 0) ? ($score / $total_questions) * 100 : 0;
    
    //ثبت نتیجه
    $stmt = $mysqli->prepare("INSERT INTO Student_Exam (student_id, exam_id, score) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $student_id, $exam_id, $final_score);
    
    if ($stmt->execute()) {
        $resultMessage = "<h3>Exam Submitted Successfully!</h3><p>Your Score: " . htmlspecialchars($final_score, ENT_QUOTES) . "</p>";
    } else {
        $resultMessage = "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit Exam</title>
    <link rel="stylesheet" href="styl/web_styl.css">
</head>
<body>
    <h2>Submit Exam</h2>

    <?php echo $resultMessage; ?>
    
</body>
</html>
