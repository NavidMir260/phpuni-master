<?php
session_start();
$output = "";

// ررسی طرز دریافت به صورت پست
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت داده ها از add exam
    $title = $_POST["title"];
    $numQuestions = $_POST["num_questions"];

    // بعد از دریافت تعداد سوالات رو میسازد  add exam  بررسی فرم

    if (!isset($_POST["questions"])) {

        ob_start();
        ?>
        <form action="create_exam.php" method="post">

            <input type="hidden" name="title" value="<?php echo htmlspecialchars($title, ENT_QUOTES); ?>">
            <input type="hidden" name="num_questions" value="<?php echo htmlspecialchars($numQuestions, ENT_QUOTES); ?>">
            <?php for ($i = 1; $i <= $numQuestions; $i++): ?>

                <div class="question">
                    <h3>Question <?php echo $i; ?>:</h3>
                    <label for="question_<?php echo $i; ?>">Question:</label>
                    <input type="text" id="question_<?php echo $i; ?>" name="questions[]" required><br><br>
                    
                    <label>Answers:</label><br>
                    <label>A: <input type="text" name="answers_<?php echo $i; ?>[]" required></label><br>
                    <label>B: <input type="text" name="answers_<?php echo $i; ?>[]" required></label><br>
                    <label>C: <input type="text" name="answers_<?php echo $i; ?>[]" required></label><br>
                    <label>D: <input type="text" name="answers_<?php echo $i; ?>[]" required></label><br>
                    
                    <label>Correct Answer: 
                        <input type="radio" name="correct_answer_<?php echo $i; ?>" value="A" required> A 
                        <input type="radio" name="correct_answer_<?php echo $i; ?>" value="B"> B 
                        <input type="radio" name="correct_answer_<?php echo $i; ?>" value="C"> C 
                        <input type="radio" name="correct_answer_<?php echo $i; ?>" value="D"> D
                    </label><br><br>
                </div>
            <?php endfor; ?>
            <input type="submit" value="Create Exam">
        </form>
        <?php

        $output = ob_get_clean();
    }
    // ثبت کل داده های برگه امتحانی
    else {
        
        $mysqli = require './connection.php';
        $teacher_id = $_SESSION['user_id'];
        $questions = $_POST["questions"];




        $Exam_Record = $mysqli->prepare("INSERT INTO Exam (teacher_id, title) VALUES (?, ?)");
        $Exam_Record->bind_param("is", $teacher_id, $title);
        if ($Exam_Record->execute()) {
            $exam_id = $Exam_Record->insert_id;
            $Exam_Record->close();

            // ثبت سوالات و پاسخ ها
            foreach ($questions as $qIndex => $question) {
                $Insert_Question = $mysqli->prepare("INSERT INTO Question (exam_id, content, question_type) VALUES (?, ?, 'MCQ')");
                $Insert_Question->bind_param("is", $exam_id, $question);
                if ($Insert_Question->execute()) {
                    $question_id = $Insert_Question->insert_id;

                    $answers = $_POST["answers_" . ($qIndex + 1)];
                    $correct_answer = $_POST["correct_answer_" . ($qIndex + 1)];


                    foreach ($answers as $aIndex => $answer) {
                        $is_correct = ($correct_answer == chr(65 + $aIndex)) ? 1 : 0;
                        $Insert_Answer = $mysqli->prepare("INSERT INTO Answer (question_id, answer_option, answer_text, is_correct) VALUES (?, ?, ?, ?)");
                        $answer_option = chr(65 + $aIndex);
                        $answer_text = $answer;
                        $Insert_Answer->bind_param("issi", $question_id, $answer_option, $answer_text, $is_correct);
                        $Insert_Answer->execute();
                        $Insert_Answer->close();
                    }
                }
                $Insert_Question->close();
            }
            $output = "Exam created successfully!";
        } else {
            $output = "Error: " . $Exam_Record->error;
        }
        $mysqli->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Exam</title>
    <link rel="stylesheet" href="styl/web_styl.css">
</head>
<body>
    <h2>Create a New Exam</h2>
    <?php
    echo $output;
    ?>
</body>
</html>
