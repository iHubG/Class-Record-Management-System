<?php
session_start();

if (isset($_POST['delete'])) {
    // Check if the student ID is provided
    if (isset($_POST['id_delete'])) {
        // Sanitize the student ID
        $student_id = $_POST['id_delete'];

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        try {
            // Begin a transaction
            $pdo->beginTransaction();

            $deletestudentsStmt = $pdo->prepare("DELETE FROM class WHERE student_id = :student_id");
            $deletestudentsStmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
            $deletestudentsStmt->execute();
          
            // Prepare a SELECT query to retrieve the student's name
            $selectStmt = $pdo->prepare("SELECT last_name FROM student WHERE id = :id");
            $selectStmt->bindParam(':id', $student_id, PDO::PARAM_INT);
            $selectStmt->execute();

            // Fetch the student's name
            $studentName = $selectStmt->fetchColumn();

            // Prepare a DELETE statement to remove the student record
            $deletestudentsStmt = $pdo->prepare("DELETE FROM student WHERE id = :id");
            $deletestudentsStmt->bindParam(':id', $student_id, PDO::PARAM_INT);
            $deletestudentsStmt->execute();

            // Log the deletion event
            $logData = "Admin $username deleted student $studentName."; // Customize as needed
            $logStmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $logStmt->execute([$logData]);

            // Commit the transaction
            $pdo->commit();

            // Check if any rows were affected
            if ($deletestudentsStmt->rowCount() > 0) {
                // student deleted successfully
                header('Location: /crms-project/admin-student');
                exit;
            } else {
                // No student found with the specified ID
                $status = 'No student found with the specified ID.';
            }
        } catch (PDOException $e) {
            // Roll back the transaction
            $pdo->rollBack();

            // Handle database errors
            $status = 'Error deleting student: ' . $e->getMessage();
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

