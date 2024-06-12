<?php
// Assuming you have already established a PDO database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Retrieve data from the form
    $studentId = $_POST["id_update"];
    $attitude = !empty($_POST["attitude"]) ? $_POST["attitude"] : null;
    $attendance = !empty($_POST["attendance"]) ? $_POST["attendance"] : null;
    $recitation = !empty($_POST["recitation"]) ? $_POST["recitation"] : null;
    $assignment = !empty($_POST["assignment"]) ? $_POST["assignment"] : null;
    $quiz = !empty($_POST["quiz"]) ? $_POST["quiz"] : null;
    $project = !empty($_POST["project"]) ? $_POST["project"] : null;
    $prelim = !empty($_POST["prelim"]) ? $_POST["prelim"] : null;
    $midterm = !empty($_POST["midterm"]) ? $_POST["midterm"] : null;
    $final = !empty($_POST["final"]) ? $_POST["final"] : null;
    $subjectId = $_SESSION['subject_id']; 

    // Fetch first name and last name from the student table
    $queryName = "SELECT first_name, last_name FROM student WHERE id = ?";
    $stmtName = $pdo->prepare($queryName);
    $stmtName->execute([$studentId]);
    $studentData = $stmtName->fetch(PDO::FETCH_ASSOC);

    $firstName = $studentData['first_name'];
    $lastName = $studentData['last_name'];

    // Compute grades
    $weights = [
        "attitude" => 0.025,
        "attendance" => 0.025,
        "recitation" => 0.025,
        "assignment" => 0.025,
        "quiz" => 0.15,
        "project" => 0.10,
        "prelim" => 0.15,
        "midterm" => 0.25,
        "final" => 0.25
    ];

    $totalScore = ($attitude / 50 * 100 * $weights["attitude"]) +
                  ($attendance / 50 * 100 * $weights["attendance"]) +
                  ($recitation / 50 * 100 * $weights["recitation"]) +
                  ($assignment / 50 * 100 * $weights["assignment"]) +
                  ($quiz / 50 * 100 * $weights["quiz"]) +
                  ($project / 50 * 100 * $weights["project"]) +
                  ($prelim / 50 * 100 * $weights["prelim"]) +
                  ($midterm / 50 * 100 * $weights["midterm"]) +
                  ($final / 50 * 100 * $weights["final"]);

    // Determine if the subject is minor or major
    $subjectType = "major"; // Set to "minor" or "major" based on your system

    // Calculate the final grade
    if ($subjectType == "minor") {
        $finalGrade = ($totalScore * 0.5) + 50;
    } elseif ($subjectType == "major") {
        $finalGrade = ($totalScore * 0.625) + 37.5;
    } else {
        // Handle other cases
    }

    // Check if a record already exists for this student and subject
    $queryCheck = "SELECT id FROM class WHERE student_id = ? AND subject_id = ?";
    $stmtCheck = $pdo->prepare($queryCheck);
    $stmtCheck->execute([$studentId, $subjectId]);
    $existingRecord = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($existingRecord) {
        // If a record exists, update it
        $queryClass = "UPDATE class 
                       SET attitude = ?, attendance = ?, recitation = ?, assignment = ?, quiz = ?, project = ?, prelim = ?, midterm = ?, final = ?, final_grade = ?
                       WHERE id = ?";
        $stmtClass = $pdo->prepare($queryClass);
        $stmtClass->execute([$attitude, $attendance, $recitation, $assignment, $quiz, $project, $prelim, $midterm, $final, $finalGrade, $existingRecord['id']]);
    } else {
        // If no record exists, insert a new one
        $queryClass = "INSERT INTO class (id, student_id, subject_id, attitude, attendance, recitation, assignment, quiz, project, prelim, midterm, final, final_grade) 
                      VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtClass = $pdo->prepare($queryClass);
        $stmtClass->execute([$studentId, $subjectId, $attitude, $attendance, $recitation, $assignment, $quiz, $project, $prelim, $midterm, $final, $finalGrade]);
    }

    // Perform an UPDATE query for first_name and last_name in the student table
    $queryUpdateName = "UPDATE student SET first_name = ?, last_name = ? WHERE id = ?";
    $stmtUpdateName = $pdo->prepare($queryUpdateName);
    $stmtUpdateName->execute([$firstName, $lastName, $studentId]);

    // Redirect to the page where the table is displayed
    header("Location: /crms-project/class-record?subject_id=" . urlencode($subjectId));
    exit();
}







