<?php
session_start();

if (isset($_POST['delete'])) {
    // Check if the subject ID is provided
    if (isset($_POST['id_delete'])) {
        // Sanitize the subject ID
        $subject_id = $_POST['id_delete'];

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        try {
            // Begin a transaction
            $pdo->beginTransaction();

            $deleteSubjectsStmt = $pdo->prepare("DELETE FROM class WHERE subject_id = :subject_id");
            $deleteSubjectsStmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $deleteSubjectsStmt->execute();
          
            // Prepare a SELECT query to retrieve the instructor's name
            $selectStmt = $pdo->prepare("SELECT subject_name FROM subjects WHERE id = :id");
            $selectStmt->bindParam(':id', $subject_id, PDO::PARAM_INT);
            $selectStmt->execute();

            // Fetch the instructor's name
            $subjectName = $selectStmt->fetchColumn();

            // Prepare a DELETE statement to remove the instructor record
            $deleteSubjectsStmt = $pdo->prepare("DELETE FROM subjects WHERE id = :id");
            $deleteSubjectsStmt->bindParam(':id', $subject_id, PDO::PARAM_INT);
            $deleteSubjectsStmt->execute();

            // Log the deletion event
            $logData = "Admin $username deleted subject $subjectName."; // Customize as needed
            $logStmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $logStmt->execute([$logData]);

            // Commit the transaction
            $pdo->commit();

            // Check if any rows were affected
            if ($deleteSubjectsStmt->rowCount() > 0) {
                // Instructor deleted successfully
                header('Location: /crms-project/admin-subject');
                exit;
            } else {
                // No instructor found with the specified ID
                $status = 'No subject found with the specified ID.';
            }
        } catch (PDOException $e) {
            // Roll back the transaction
            $pdo->rollBack();

            // Handle database errors
            $status = 'Error deleting subject: ' . $e->getMessage();
        }
    } else {
        // Instructor ID is not provided
        $status = 'subject ID is not provided.';
    }
}

// Display status message if needed
if (isset($status)) {
    echo $status;
}

