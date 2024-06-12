<?php
// Assuming you have already established a PDO database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Retrieve the student ID to be deleted from the form
    $studentIdToDelete = $_POST["id_delete"];
    $subjectId = $_SESSION['subject_id']; // Get the subject ID from the session

    // Perform the deletion from the class table for the specific subject and student
    $queryDeleteFromClass = "DELETE FROM class WHERE student_id = ? AND subject_id = ?";
    $stmtDeleteFromClass = $pdo->prepare($queryDeleteFromClass);
    $stmtDeleteFromClass->execute([$studentIdToDelete, $subjectId]);

    // Redirect to the page where the table is displayed
    header("Location: /crms-project/class-record?subject_id=" . urlencode($subjectId));
    exit();
}
