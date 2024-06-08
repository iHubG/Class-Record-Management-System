<?php
// Start or resume the session
session_start();

$name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Instructor';


// Check if the instructor is logged in
if (isset($_SESSION['instructor_id'])) {
    // Get the instructor ID from the session
    $instructorId = $_SESSION['instructor_id'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $subjectName = $_POST["subjectName"];
        $subjectCode = $_POST["subjectCode"];
        $section = $_POST["section"];

        // Check if connection is successful
        if ($pdo) {
            // Prepare SQL statement
            $stmt = $pdo->prepare("INSERT INTO subjects (instructor_id, subject_name, subject_code, section) VALUES (:instructorId, :subjectName, :subjectCode, :section)");

            // Bind parameters
            $stmt->bindParam(":instructorId", $instructorId);
            $stmt->bindParam(":subjectName", $subjectName);
            $stmt->bindParam(":subjectCode", $subjectCode);
            $stmt->bindParam(":section", $section);

            // Execute the statement
            if ($stmt->execute()) {
                // Return success message
                $logData = "Instructor $name added subject."; // Customize as needed
                $stmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
                $stmt->execute([$logData]);    
                echo "Subject added successfully!";
            } else {
                // Return error message if insertion fails
                echo "Error: Failed to add subject. Please try again later.";
            }
        } else {
            // Return error message if database connection fails
            echo "Error: Failed to connect to the database.";
        }
    } else {
        // If the form is not submitted via POST method, return an error
        echo "Error: Form submission method not allowed.";
    }
} else {
  ;
}

