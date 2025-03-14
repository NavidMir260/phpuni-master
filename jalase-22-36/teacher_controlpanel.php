<?php
session_start();

// بررسی ساین این بودن معلم
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    exit;
}

// اتصال به دیتا بیس
$mysqli = require './connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Control Panel</title>
    <link rel="stylesheet" href="styl/web_styl.css">

    <!-- طراحی لازم برای تمیز تر شدن صفحه -->
    <style>
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { padding: 8px 12px; border: 1px solid #5463ff; }
        th { background-color: #6a69ff; }
        a { color: #5463ff !important; }
        .nav { margin-bottom: 20px; }
        .nav form { display: inline; margin-right: 15px; }
    </style>
</head>
<body>
    <h2>Teacher Control Panel</h2>

    <!-- add_exam.php انتقل به سایت-->
    <div class="nav">
        <form action="add_exam.php" method="get" style="display: inline;">
            <input type="submit" value="Create a New Exam">
        </form>
    </div>

    <?php
    // نتایج ازممون
    if (isset($_GET['exam_id'])) {
        $exam_id = intval($_GET['exam_id']);
        $teacher_id = $_SESSION['user_id'];

        // پیدا کردن ازمون متعلق به این استاد
        $verifyExamBelongsToTeacherQuery = $mysqli->prepare("SELECT title FROM Exam WHERE exam_id = ? AND teacher_id = ?");
        $verifyExamBelongsToTeacherQuery->bind_param("ii", $exam_id, $teacher_id);
        $verifyExamBelongsToTeacherQuery->execute();
        $verifyExamBelongsToTeacherQuery->store_result();

        if ($verifyExamBelongsToTeacherQuery->num_rows == 0) {
            echo "<p>Exam not found.</p>";
        } else {
            $verifyExamBelongsToTeacherQuery->bind_result($exam_title);
            $verifyExamBelongsToTeacherQuery->fetch();

            echo "<h3>Results for Exam: " . htmlspecialchars($exam_title) . "</h3>";
            echo "<p><a href='teacher_controlpanel.php'>&larr; Back to Exam List</a></p>";

            // گرفتن نمره و اطلاعات دانش اموز
            $fetchExamResultsQuery = $mysqli->prepare("
                SELECT U.first_name, U.last_name, SE.score, SE.completed_at 
                FROM Student_Exam SE 
                JOIN Users U ON SE.student_id = U.user_id 
                WHERE SE.exam_id = ? 
                ORDER BY SE.completed_at DESC
            ");
            $fetchExamResultsQuery->bind_param("i", $exam_id);
            $fetchExamResultsQuery->execute();
            $result = $fetchExamResultsQuery->get_result();


            // نمایش نتایج گرفته شده از بالا در یک جدول
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Score</th>
                          <th>Date Completed</th>
                      </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['score']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['completed_at']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No student has taken this exam yet.</p>";
            }
            $fetchExamResultsQuery->close();
        }
        $verifyExamBelongsToTeacherQuery->close();

    } else {
        // حالت نمایش تمام امتحان هایی که این استاد درست کرده
        $teacher_id = $_SESSION['user_id'];
        $fetchTeacherExamsQuery = $mysqli->prepare("SELECT exam_id, title, created_at FROM Exam WHERE teacher_id = ? ORDER BY created_at DESC");
        $fetchTeacherExamsQuery->bind_param("i", $teacher_id);
        $fetchTeacherExamsQuery->execute();
        $result_exams = $fetchTeacherExamsQuery->get_result();

        if ($result_exams->num_rows > 0) {
            echo "<h3>Your Created Exams</h3>";
            echo "<ul>";
            while ($row = $result_exams->fetch_assoc()) {
                echo "<li>";
                echo "<a href='teacher_controlpanel.php?exam_id=" . urlencode($row['exam_id']) . "'>" . htmlspecialchars($row['title']) . "</a> ";
                echo "(Created: " . htmlspecialchars($row['created_at']) . ")";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>You haven't created any exams yet.</p>";
        }
        $fetchTeacherExamsQuery->close();
    }

    $mysqli->close();
    ?>
</body>
</html>
