<?php 
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate form fields
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Function to insert a new instructor record
    function insertStudent($pdo, $fname, $lname, $username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO student (first_name, last_name, username, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fname, $lname, $username, $hashedPassword]);
        return $pdo->lastInsertId();
    }

    // Get the current date and time
    $dateCreated = date('Y-m-d H:i:s');

    // Read existing JSON data from credentials.json
    $existing_data = file_get_contents('./student_credentials.json');
    $existing_credentials = json_decode($existing_data, true);

    // Append new instructor credentials to existing data
    $student_credentials = array(
        'fname' => $fname,
        'lname' => $lname,
        'username' => $username,
        'password' => $password,
        'date_created' => $dateCreated,
    );
    $existing_credentials[] = $student_credentials;

    // Encode the combined data as JSON
    $json_data = json_encode($existing_credentials, JSON_PRETTY_PRINT);

    // Write JSON data back to credentials.json
    $result = file_put_contents('./student_credentials.json', $json_data);

    // Insert the new student record
    $studentId = insertStudent($pdo, $fname, $lname, $username, $password);

    // Check if the student insertion was successful
    if ($studentId) {
        // Insert into the class table
        $subjectId = $_SESSION['subject_id'];
        insertIntoClass($pdo, $subjectId, $studentId);

        // Output success message
        echo "success";
        exit;
    } else {
        // If student insertion fails, handle the error
        http_response_code(500); // Internal Server Error
        echo "Error inserting student record";
    }

} else {
    // If there are validation errors, return them as JSON
    http_response_code(400); // Set HTTP response status code to 400 (Bad Request)
    echo json_encode($errors); // Return validation errors as JSON
}

// Function to insert into class table
function insertIntoClass($pdo, $subjectId, $studentId) {
    $stmt = $pdo->prepare("INSERT INTO class (subject_id, student_id) VALUES (?, ?)");
    $stmt->execute([$subjectId, $studentId]);
}
