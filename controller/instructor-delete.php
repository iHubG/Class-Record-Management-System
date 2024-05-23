<?php
if (isset($_POST['delete'])) {
    // Check if the instructor ID is provided
    if (isset($_POST['id_delete'])) {
        // Sanitize the instructor ID
        $instructor_id = $_POST['id_delete'];

        try {
            // Prepare a DELETE statement to remove the instructor record
            $stmt = $pdo->prepare("DELETE FROM instructor WHERE id = :instructor_id");
            $stmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);

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

?>