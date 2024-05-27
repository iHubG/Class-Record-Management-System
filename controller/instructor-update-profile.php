<?php
session_start(); // Start the session

// If there are no validation errors and the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the instructor's ID from the session
    $instructorID = $_SESSION['instructor_id'];

    // Update the instructor's name in the database
    $name = $_POST['name']; // Get the submitted name
    // Prepare the update query for the name
    $updateNameQuery = "UPDATE Instructor SET name = :name WHERE id = :id";
    $statement = $pdo->prepare($updateNameQuery);
    // Bind parameters for the name update
    $statement->bindParam(':name', $name);
    $statement->bindParam(':id', $instructorID);
    // Execute the name update query
    if (!$statement->execute()) {
        // Handle error if name update fails
        // Log the error or display an appropriate message
    }

    // Store the selected department in the session
    $department = $_POST['department'];
    $_SESSION['department'] = $department;

    // Prepare query to update or insert department
    $updateDepartmentQuery = "INSERT INTO Instructor (id, department) VALUES (:id, :department) ON DUPLICATE KEY UPDATE department = :department";
    $statement = $pdo->prepare($updateDepartmentQuery);
    // Bind parameters for the department update/insert
    $statement->bindParam(':id', $instructorID);
    $statement->bindParam(':department', $department);
    // Execute the department update/insert query
    if (!$statement->execute()) {
        // Handle error if department update/insert fails
        // Log the error or display an appropriate message
    }

    echo "success";
    exit(); // Stop further execution
}

