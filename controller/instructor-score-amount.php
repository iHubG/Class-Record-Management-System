<?php
// Assuming you have already established a PDO database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["scoreAmount"])) {
    // Retrieve data from the form
    $attitudeAmount = !empty($_POST["attitudeAmount"]) ? $_POST["attitudeAmount"] : null;
    $attendanceAmount = !empty($_POST["attendanceAmount"]) ? $_POST["attendanceAmount"] : null;
    $recitationAmount = !empty($_POST["recitationAmount"]) ? $_POST["recitationAmount"] : null;
    $assignmentAmount = !empty($_POST["assignmentAmount"]) ? $_POST["assignmentAmount"] : null;
    $quizAmount = !empty($_POST["quizAmount"]) ? $_POST["quizAmount"] : null;
    $projectAmount = !empty($_POST["projectAmount"]) ? $_POST["projectAmount"] : null;
    $prelimAmount = !empty($_POST["prelimAmount"]) ? $_POST["prelimAmount"] : null;
    $midtermAmount = !empty($_POST["midtermAmount"]) ? $_POST["midtermAmount"] : null;
    $finalAmount = !empty($_POST["finalAmount"]) ? $_POST["finalAmount"] : null;

    // Get the subject ID from the session
    $subjectId = $_SESSION['subject_id'];

    // Update the score amounts into the database for the existing row
    try {
        $query = "UPDATE class 
                  SET 
                  attitude_amount = ?, 
                  attendance_amount = ?, 
                  recitation_amount = ?, 
                  assignment_amount = ?, 
                  quiz_amount = ?, 
                  project_amount = ?, 
                  prelim_amount = ?, 
                  midterm_amount = ?, 
                  final_amount = ? 
                  WHERE subject_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$attitudeAmount, $attendanceAmount, $recitationAmount, $assignmentAmount, $quizAmount, $projectAmount, $prelimAmount, $midtermAmount, $finalAmount, $subjectId]);

        // Redirect to the page after successful submission
        header("Location: /crms-project/class-record?subject_id=" . urlencode($subjectId));
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
