<?php  
session_start();
$errors = [];

if(isset($_SESSION['username'])) {
    $usernameAdmin = $_SESSION['username'];
}

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
        // Store the data into the database instructor table
        // Function to check if name or username already exist
        function instructorExists($pdo, $name, $username) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM instructor WHERE name = ? OR username = ?");
            $stmt->execute([$name, $username]);
            return $stmt->fetchColumn() > 0;
        }

        // Function to insert a new instructor record
        function insertInstructor($pdo, $name, $username, $password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO instructor (name, username, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $username, $hashedPassword]);
            return $pdo->lastInsertId();
        }

         // Get the current date and time
        $dateCreated = date('Y-m-d H:i:s');

        // Check if instructor with the same name or username already exists
        if (!instructorExists($pdo, $name, $username)) {
            $instructor_credentials = array(
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'date_created' => $dateCreated,
            );
    
           // Read existing JSON data from credentials.json
            $existing_data = file_get_contents('./credentials.json');
            $existing_credentials = json_decode($existing_data, true);

            // Append new instructor credentials to existing data
            $existing_credentials[] = $instructor_credentials;

            // Encode the combined data as JSON
            $json_data = json_encode($existing_credentials, JSON_PRETTY_PRINT);

            // Write JSON data back to credentials.json
            $result = file_put_contents('./credentials.json', $json_data);

            $logData = "Admin $usernameAdmin registered instructor $name."; // Customize as needed
            $stmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $stmt->execute([$logData]);

            // Insert the new instructor record
            $instructorId = insertInstructor($pdo, $name, $username, $password);
            echo "success";
            exit;
        } else {
            // Return error if instructor with the same name or username already exists
            $errors['username'] = "Instructor with the same name or username already exists";
            http_response_code(400); // Set HTTP response status code to 400 (Bad Request)
            echo json_encode($errors); // Return validation errors as JSON
        }
        
        echo "success";
        exit;
    } else {
        // If there are validation errors, return them as JSON
        http_response_code(400); // Set HTTP response status code to 400 (Bad Request)
        echo json_encode($errors); // Return validation errors as JSON
    }
}

