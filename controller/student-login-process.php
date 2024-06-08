<?php 
session_start();

$errors = [];

// Validate username
if (empty($_POST['username'])) {
    $errors['username'] = "Username is required";
} else {
    $username = $_POST['username'];
}

// Validate password
if (empty($_POST['password'])) {
    $errors['password'] = "Password is required";
} else {
    $password = $_POST['password'];
}

// Redirect if there are errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: /crms-project/student-login");
    exit(); // Exit immediately after redirection
}


// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    try {
        $stmt = $pdo->prepare("SELECT * FROM instructor WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, start a new session
            $_SESSION['student_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $name = $_SESSION['first_name'] . $SESSION_['last_name'];

            $logData = "Student $name logged in."; // Customize as needed
            $stmt = $pdo->prepare("INSERT INTO activity_logs (log_data) VALUES (?)");
            $stmt->execute([$logData]);

            // Clear remember cookie
            setcookie('student_credentials', '', time() - 3600, '/');

            if (isset($_POST['rememberMe'])){
                // Set a cookie to remember the username and password for a week
                $cookieData = [
                    'username' => $username,
                    'password' => $password,
                ];
                $cookieValue = json_encode($cookieData);
                setcookie('student_credentials', $cookieValue, time() + (86400 * 7), "/"); // Cookie lasts for 7 days
            }

            // Redirect to the dashboard
            header('Location: /crms-project/student-dashboard');
            exit();
        } else {
            $errors['login'] = "Invalid username or password";
        }
    } catch (PDOException $e) {
        // Handle database errors
        $errors['login'] = 'An error occurred: ' . $e->getMessage();
    }

    // Save errors in session for displaying on the form
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;

    // Redirect back to the login page
    header("Location: /crms-project/student-login");
    exit();
}

