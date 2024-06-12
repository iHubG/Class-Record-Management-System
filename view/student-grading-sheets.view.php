<?php 
session_start();
// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: /crms-project/student-login');
    exit();
}

// Ensure a subject ID is provided
if (!isset($_GET['subject_id']) || !is_numeric($_GET['subject_id'])) {
    // Handle the case when no subject ID is provided
    echo "Please select a subject.";
    exit();
}

$subject_id = $_GET['subject_id'];
$student_id = $_SESSION['student_id'];

$_SESSION['subject_id'] = $subject_id;

// Check if the logged-in student is enrolled in the selected subject
$stmt = $pdo->prepare("SELECT * FROM class WHERE subject_id = :subject_id AND student_id = :student_id");
$stmt->execute(['subject_id' => $subject_id, 'student_id' => $student_id]);
$enrollment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$enrollment) {
    // Handle the case when the student is not enrolled in the subject
    echo "You are not enrolled in this subject.";
    exit();
}

// Fetch subject details
$stmt = $pdo->prepare("SELECT subject_name, section FROM subjects WHERE id = :subject_id");
$stmt->execute(['subject_id' => $subject_id]);
$subject = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$subject) {
    // Handle the case when the subject details are not found (unlikely scenario)
    echo "Subject details not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Class Record & Grade Sheet</title>
</head>
<body>
    <a href="/crms-project/student-dashboard" class="text-black"><i class="bi bi-arrow-left-circle fs-1 ms-2 ms-lg-5 mt-5 cursor-pointer back" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Go back"  data-bs-custom-class="custom-tooltip"></i></a>
    <h2 class="text-center mt-3 mb-5"><?php echo htmlspecialchars($subject['subject_name'] . ' ' . $subject['section'] ); ?> Class Record and Grade Sheet</h2>
    <div class="container-fluid">
        <?php 
           // Query to retrieve student details for the logged-in student and the given subject ID
            $stmt = $pdo->prepare("SELECT student.first_name, student.last_name, class.attitude, class.attendance, class.recitation, class.assignment, class.quiz, class.project, class.prelim, class.midterm, class.final, class.final_grade, class.remarks
            FROM student 
            INNER JOIN class ON student.id = class.student_id 
            WHERE class.subject_id = ? AND class.student_id = ?");
            $stmt->execute([$subject_id, $student_id]);

            // Fetch student details from the database
            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($student) {
            // Display the student's details
            echo "<table class='table table-striped'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Attitude</th>
            <th>Attendance</th>
            <th>Recitation</th>
            <th>Assignment</th>
            <th>Quiz</th>
            <th>Project</th>
            <th>Prelim</th>
            <th>Midterm</th>
            <th>Final</th>
            <th>Final Grade</th>
            <th>Remarks</th>
            </tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $student['last_name'] . "</td>";
            echo "<td>" . $student['first_name'] . "</td>";
            echo "<td>" . $student['attitude'] . "</td>";
            echo "<td>" . $student['attendance'] . "</td>";
            echo "<td>" . $student['recitation'] . "</td>";
            echo "<td>" . $student['assignment'] . "</td>";
            echo "<td>" . $student['quiz'] . "</td>";
            echo "<td>" . $student['project'] . "</td>";
            echo "<td>" . $student['prelim'] . "</td>";
            echo "<td>" . $student['midterm'] . "</td>";
            echo "<td>" . $student['final'] . "</td>";
            echo "<td>" . $student['final_grade'] . "</td>";
            echo "<td>" . $student['remarks'] . "</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            } else {
            // Handle the case when the student record is not found (unlikely scenario)
            echo "Student record not found.";
            }
        ?>
    </div>
</body>
</html>
