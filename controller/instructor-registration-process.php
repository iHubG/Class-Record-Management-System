<?php  

$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an empty array to store validation errors
    $errors = array();

    // Validate form fields
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate name
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }

    // Validate username
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    // Validate password
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long";
    }

    // If there are no validation errors, process the form submission
    if (empty($errors)) {
        // Process form data (e.g., save to database)
        // For demonstration purposes, let's just echo a success message
        echo "success";
        exit;
    } else {
        // If there are validation errors, return them as JSON
        http_response_code(400); // Set HTTP response status code to 400 (Bad Request)
        echo json_encode($errors); // Return validation errors as JSON
    }
}

