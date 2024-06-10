<?php
session_start();
if (isset($_POST['update'])) {
    // Check if the student ID is provided
    if (isset($_POST['id_update'])) {
        // Sanitize the student ID
        $studentID = $_POST['id_update'];

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        // Update the student's profile in the database
        $firstName = $_POST['firstName']; // Get the submitted first name
        $lastName = $_POST['lastName']; // Get the submitted last name
        $schoolId = $_POST['schoolId']; // Get the submitted school ID
        $course = $_POST['course']; // Get the submitted course
        $yearLevel = $_POST['year']; // Get the submitted year level
        
        // Prepare the update query for the student's profile
        $updateProfileQuery = "UPDATE student SET first_name = :first_name, last_name = :last_name, school_id = :school_id, course = :course, year_level = :year_level WHERE id = :id";
        $statement = $pdo->prepare($updateProfileQuery);
        // Bind parameters for the student's profile update
        $statement->bindParam(':first_name', $firstName);
        $statement->bindParam(':last_name', $lastName);
        $statement->bindParam(':school_id', $schoolId);
        $statement->bindParam(':course', $course);
        $statement->bindParam(':year_level', $yearLevel);
        $statement->bindParam(':id', $studentID);
  
        // Execute the update query
        if ($statement->execute()) {
            // Log the update event
            $logData = "Admin $username updated student $firstName."; // Customize as needed
            $logStmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $logStmt->execute([$logData]);

            header('Location: /crms-project/admin-student');
            exit(); // Ensure script execution stops after redirect
        } else {
            // Handle update failure
            header('Location: /crms-project/admin-student');
            $status = 'Failed to update student.';
        }
    } else {
        // student ID is not provided
        $status = 'student ID is not provided.';
    }
}

// Display status message if needed
if (isset($status)) {
    echo $status;
}
