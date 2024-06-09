<?php 
session_start();

// Function to check if username already exists
function isUsernameExists($pdo, $username) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM student WHERE username = ?");
    $stmt->execute([$username]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

// Function to get student ID by username
function getStudentIdByUsername($pdo, $username) {
    $stmt = $pdo->prepare("SELECT id FROM student WHERE username = ?");
    $stmt->execute([$username]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    return $student ? $student['id'] : null;
}

// Function to check if a student is already enrolled in a subject
function isStudentEnrolled($pdo, $subjectId, $studentId) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM class WHERE subject_id = ? AND student_id = ?");
    $stmt->execute([$subjectId, $studentId]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $username = $_POST['username'];

    // Check if username already exists
    if (!isUsernameExists($pdo, $username)) {
        // Username does not exist, return an error message
        http_response_code(400); // Bad Request
        echo "Username does not exist";
        exit;
    }

    // Get student ID by username
    $studentId = getStudentIdByUsername($pdo, $username);

    // Get subject ID from session
    $subjectId = $_SESSION['subject_id'];

    // Debugging: Check if the student ID and subject ID are correct
    echo "Student ID: $studentId, Subject ID: $subjectId";

    // Check if the student is already enrolled in the subject
    if (isStudentEnrolled($pdo, $subjectId, $studentId)) {
        // Student is already enrolled, return an error message
        http_response_code(400); // Bad Request
        echo "Student is already enrolled in this subject";
        exit;
    }

    // Student is not enrolled, insert into class table
    $stmt = $pdo->prepare("INSERT INTO class (subject_id, student_id) VALUES (?, ?)");
    $stmt->execute([$subjectId, $studentId]);

    // Output success message
    echo "Student enrolled successfully";
    exit;
}

