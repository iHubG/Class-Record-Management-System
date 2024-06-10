<?php
session_start(); // Start the session

// If there are no validation errors and the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the student's ID from the session
    $studentID = $_SESSION['student_id'];

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
    // Execute the student's profile update query
    if (!$statement->execute()) {
        // Handle error if student's profile update fails
        // Log the error or display an appropriate message
    }
    
    // Log the activity
    $logData = "Student $firstName $lastName updated profile."; // Customize as needed
    $stmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
    $stmt->execute([$logData]);
    
    echo "success";
    exit(); // Stop further execution
}
