<?php
session_start();

// Retrieve the username from the session
if(isset($_SESSION['name'])) {
    $name = $_SESSION['name'];

    // Log the logout event
    $logData = "Instructor $name logged out."; // Customize as needed

    // Assuming $pdo is your PDO object initialized previously
    $stmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
    $stmt->execute([$logData]);

    // Destroy all session data
    session_destroy();
} else {
   
}

// Redirect to login page
header("Location: /crms-project/instructor-login");

exit();