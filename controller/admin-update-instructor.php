<?php
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the instructor's ID from the session
    $instructorID = $_POST['instructor_id'];

    // Validate form data
    $name = $_POST['name'];
    $department = $_POST['department'];

    // Perform server-side validation as needed

    // Update the instructor's name in the database
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
        echo "Error updating name.";
        exit();
    }

    // Update the instructor's department in the database
    // Prepare the update query for the department
    $updateDepartmentQuery = "UPDATE Instructor SET department = :department WHERE id = :id";
    $statement = $pdo->prepare($updateDepartmentQuery);
    // Bind parameters for the department update
    $statement->bindParam(':department', $department);
    $statement->bindParam(':id', $instructorID);
    // Execute the department update query
    if (!$statement->execute()) {
        // Handle error if department update fails
        // Log the error or display an appropriate message
        echo "Error updating department.";
        exit();
    }

    // If updates are successful, redirect to a success page or display a success message
    // header("Location: /crms-project/success.php");
    echo "Instructor information updated successfully.";
    exit();
}
?>
