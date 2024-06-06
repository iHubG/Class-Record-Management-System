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

        // Prepare a SELECT query to retrieve the instructor's name
        $selectStmt = $pdo->prepare("SELECT name FROM instructor WHERE id = :instructor_id");
        $selectStmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);
        $selectStmt->execute();

        // Fetch the instructor's name
        $instructorName = $selectStmt->fetchColumn();

        try {
            // Prepare a DELETE statement to remove the instructor record
            $stmt = $pdo->prepare("DELETE FROM instructor WHERE id = :instructor_id");
            $stmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);

            // Log the deletion event
            $logData = "Admin $username deleted instructor $instructorName."; // Customize as needed
            $logStmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $logStmt->execute([$logData]);

            // Execute the DELETE statement
            $stmt->execute();

            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                // Instructor deleted successfully
                header('Location: /crms-project/admin-instructor-dash');
                exit;
            } else {
                // No instructor found with the specified ID
                $status = 'No instructor found with the specified ID.';
            }
        } catch (PDOException $e) {
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

