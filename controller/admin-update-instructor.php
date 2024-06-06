<?php
session_start(); // Start the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the instructor's ID from the session
    $instructorID = $_POST['instructor_id'];

    $name = $_POST['name'];
    $department = $_POST['department'];

    // Perform server-side validation as needed

   

    // Start a transaction
    $pdo->beginTransaction();

    try {
        // Update the instructor's name and department in the database
        $updateQuery = "UPDATE Instructor SET name = :name, department = :department WHERE id = :id";
        $statement = $pdo->prepare($updateQuery);
        // Bind parameters for the update
        $statement->bindParam(':name', $name);
        $statement->bindParam(':department', $department);
        $statement->bindParam(':id', $instructorID);
        // Execute the update query
        $statement->execute();

        // Commit the transaction
        $pdo->commit();

        echo "Instructor information updated successfully.";

        $logData = "Admin $username updated instructor $name."; 
        $stmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
        $stmt->execute([$logData]);
    } catch (PDOException $e) {
        // Roll back the transaction on error
        $pdo->rollBack();
        // Log the error or display an appropriate message
        echo "Error updating instructor information: " . $e->getMessage();
    }
    exit();
}

