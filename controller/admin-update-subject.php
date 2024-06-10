<?php
session_start();
if (isset($_POST['update'])) {
    // Check if the subject ID is provided
    if (isset($_POST['id_update'])) {
        // Sanitize the subject ID
        $subjectID = $_POST['id_update'];

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        // Update the subject's profile in the database
        $subjectName = $_POST['subjectName']; // Get the submitted subject name
        $subjectCode = $_POST['subjectCode']; // Get the submitted last name
        $section = $_POST['section']; // Get the submitted school ID
        
        // Prepare the update query for the subject's profile
        $updateProfileQuery = "UPDATE subjects SET subject_name = :subject_name, subject_code = :subject_code, section = :section WHERE id = :id";
        $statement = $pdo->prepare($updateProfileQuery);
        // Bind parameters for the subject's profile update
        $statement->bindParam(':subject_name', $subjectName);
        $statement->bindParam(':subject_code', $subjectCode);
        $statement->bindParam(':section', $section);
        $statement->bindParam(':id', $subjectID);
  
        // Execute the update query
        if ($statement->execute()) {
            // Log the update event
            $logData = "Admin $username updated subject $subjectName."; // Customize as needed
            $logStmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $logStmt->execute([$logData]);

            header('Location: /crms-project/admin-subject');
            exit(); // Ensure script execution stops after redirect
        } else {
            // Handle update failure
            header('Location: /crms-project/admin-subject');
            $status = 'Failed to update subject.';
        }
    } else {
        // subject ID is not provided
        $status = 'subject ID is not provided.';
    }
}

// Display status message if needed
if (isset($status)) {
    echo $status;
}
