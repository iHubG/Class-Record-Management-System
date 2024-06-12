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
    $category = !empty($_POST["category"]) ? $_POST["category"] : null;
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

  // Retrieve the score amounts from the database
$query = "SELECT attitude_amount, attendance_amount, recitation_amount, assignment_amount, quiz_amount, project_amount, prelim_amount, midterm_amount, final_amount FROM class WHERE subject_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$subjectId]);
$scoreAmounts = $stmt->fetch(PDO::FETCH_ASSOC);

// Use the retrieved score amounts to calculate the total score
$totalScore = ($attitude / $scoreAmounts['attitude_amount'] * 100 * $weights["attitude"]) +
              ($attendance / $scoreAmounts['attendance_amount'] * 100 * $weights["attendance"]) +
              ($recitation / $scoreAmounts['recitation_amount'] * 100 * $weights["recitation"]) +
              ($assignment / $scoreAmounts['assignment_amount'] * 100 * $weights["assignment"]) +
              ($quiz / $scoreAmounts['quiz_amount'] * 100 * $weights["quiz"]) +
              ($project / $scoreAmounts['project_amount'] * 100 * $weights["project"]) +
              ($prelim / $scoreAmounts['prelim_amount'] * 100 * $weights["prelim"]) +
              ($midterm / $scoreAmounts['midterm_amount'] * 100 * $weights["midterm"]) +
              ($final / $scoreAmounts['final_amount'] * 100 * $weights["final"]);

  
  $subjectType = $category;
  // Calculate the final grade based on the subject type
  if ($subjectType == "minor") {
    $rawGrade = ($totalScore * 0.5) + 50;
  } elseif ($subjectType == "major") {
    $rawGrade = ($totalScore * 0.625) + 37.5;
  } else {
    // Handle other cases
  }
                  
    // Determine the equivalent final grade based on the provided grading scale
    if ($rawGrade >= 98) {
        $finalGrade = 1.0;
    } elseif ($rawGrade >= 95) {
        $finalGrade = 1.25;
    } elseif ($rawGrade >= 92) {
        $finalGrade = 1.5;
    } elseif ($rawGrade >= 89) {
        $finalGrade = 1.75;
    } elseif ($rawGrade >= 86) {
        $finalGrade = 2.0;
    } elseif ($rawGrade >= 83) {
        $finalGrade = 2.25;
    } elseif ($rawGrade >= 80) {
        $finalGrade = 2.5;
    } elseif ($rawGrade >= 77) {
        $finalGrade = 2.75;
    } elseif ($rawGrade >= 75) {
        $finalGrade = 3.0;
    } elseif ($rawGrade >= 70) {
        $finalGrade = 4.0;
    } else {
        $finalGrade = 5.0;
    }

// Determine remarks based on final grade
$remarks = ($finalGrade >= 1.0 && $finalGrade <= 3.0) ? "Passed" : "Failed";

// Check if a record already exists for this student and subject
$queryCheck = "SELECT id FROM class WHERE student_id = ? AND subject_id = ?";
$stmtCheck = $pdo->prepare($queryCheck);
$stmtCheck->execute([$studentId, $subjectId]);
$existingRecord = $stmtCheck->fetch(PDO::FETCH_ASSOC);

if ($existingRecord) {
    // If a record exists, update it
    $queryClass = "UPDATE class 
                   SET attitude = ?, attendance = ?, recitation = ?, assignment = ?, quiz = ?, project = ?, prelim = ?, midterm = ?, final = ?, final_grade = ?, remarks = ?, category = ?
                   WHERE id = ?";
    $stmtClass = $pdo->prepare($queryClass);
    $stmtClass->execute([$attitude, $attendance, $recitation, $assignment, $quiz, $project, $prelim, $midterm, $final, $finalGrade, $remarks, $category, $existingRecord['id']]);
} else {
    // If no record exists, insert a new one
    $queryClass = "INSERT INTO class (id, student_id, subject_id, attitude, attendance, recitation, assignment, quiz, project, prelim, midterm, final, final_grade, remarks, category) 
                  VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtClass = $pdo->prepare($queryClass);
    $stmtClass->execute([$studentId, $subjectId, $attitude, $attendance, $recitation, $assignment, $quiz, $project, $prelim, $midterm, $final, $finalGrade, $remarks, $category]);
}


    // Perform an UPDATE query for first_name and last_name in the student table
    $queryUpdateName = "UPDATE student SET first_name = ?, last_name = ? WHERE id = ?";
    $stmtUpdateName = $pdo->prepare($queryUpdateName);
    $stmtUpdateName->execute([$firstName, $lastName, $studentId]);

    // Redirect to the page where the table is displayed
    header("Location: /crms-project/class-record?subject_id=" . urlencode($subjectId));
    exit();
}

