<?php
session_start();

if (isset($_POST['delete'])) {
    // Check if the instructor ID is provided
    if (isset($_POST['id_delete'])) {
        // Sanitize the instructor ID
        $instructor_id = $_POST['id_delete'];

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        try {
            // Begin a transaction
            $pdo->beginTransaction();

            // Prepare a DELETE statement to remove associated subjects
            $deleteSubjectsStmt = $pdo->prepare("DELETE FROM subjects WHERE instructor_id = :instructor_id");
            $deleteSubjectsStmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);
            $deleteSubjectsStmt->execute();

            // Prepare a SELECT query to retrieve the instructor's name
            $selectStmt = $pdo->prepare("SELECT name FROM instructor WHERE id = :instructor_id");
            $selectStmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);
            $selectStmt->execute();

            // Fetch the instructor's name
            $instructorName = $selectStmt->fetchColumn();

            // Prepare a DELETE statement to remove the instructor record
            $deleteInstructorStmt = $pdo->prepare("DELETE FROM instructor WHERE id = :instructor_id");
            $deleteInstructorStmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);

            // Execute the DELETE statement
            $deleteInstructorStmt->execute();

            // Log the deletion event
            $logData = "Admin $username deleted instructor $instructorName."; // Customize as needed
            $logStmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $logStmt->execute([$logData]);

            // Commit the transaction
            $pdo->commit();

            // Check if any rows were affected
            if ($deleteInstructorStmt->rowCount() > 0) {
                // Instructor deleted successfully
                header('Location: /crms-project/admin-instructor-dash');
                exit;
            } else {
                // No instructor found with the specified ID
                $status = 'No instructor found with the specified ID.';
            }
        } catch (PDOException $e) {
            // Roll back the transaction
            $pdo->rollBack();

            // Handle database errors
            $status = 'Error deleting instructor: ' . $e->getMessage();
        }
    } else {
        // Instructor ID is not provided
        $status = 'Instructor ID is not provided.';
    }
}

// Display status message if needed
if (isset($status)) {
    echo $status;
}

