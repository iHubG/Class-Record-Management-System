<?php
// Assuming you have already established a PDO database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["score"])) {
    // Retrieve data from the form
    $studentId = $_POST["id_addScore"];
    $quizScore = !empty($_POST["addScore"]) ? $_POST["addScore"] : null;
    $projectScore = !empty($_POST["addProject"]) ? $_POST["addProject"] : null;
    $subjectId = $_SESSION['subject_id'];

    // Retrieve the class ID from the database based on student ID and subject ID
    $queryClassId = "SELECT id FROM class WHERE student_id = ? AND subject_id = ?";
    $stmtClassId = $pdo->prepare($queryClassId);
    $stmtClassId->execute([$studentId, $subjectId]);
    $classRow = $stmtClassId->fetch(PDO::FETCH_ASSOC);

    // Check if the class record exists
    if ($classRow) {
        $classId = $classRow['id'];

        // Retrieve existing scores from the database
        $queryScores = "SELECT quiz, project FROM class WHERE id = ?";
        $stmtScores = $pdo->prepare($queryScores);
        $stmtScores->execute([$classId]);
        $existingScores = $stmtScores->fetch(PDO::FETCH_ASSOC);

        // Calculate the new quiz score
        $totalQuizScore = $existingScores['quiz'] + $quizScore;

        // Calculate the new project score
        $totalProjectScore = $existingScores['project'] + $projectScore;

        // Perform database update for quiz and project scores
        $updateQuery = "UPDATE class 
                        SET quiz = ?, project = ?
                        WHERE id = ?";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute([$totalQuizScore, $totalProjectScore, $classId]);

        // Redirect to the page where the table is displayed
        header("Location: /crms-project/class-record?subject_id=" . urlencode($subjectId));
        exit();
    } else {
        // Handle the case where the class record doesn't exist
        // You can display an error message or redirect the user to another page
    }
}

