<?php /*
session_start();

$errors = [];

// Validate email
if (empty($_POST['username'])) {
    $errors['username'] = "Username is required";
} else {
    $email = $_POST['email'];
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
    header("Location: /crms-project/admin-login");
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
    $stmt = $pdo->prepare("SELECT * FROM admin");
    $stmt->execute();
    $users = $stmt->fetchAll();
     
    foreach($users as $user) {
         
        if(($user['username'] == $username) && 
            ($user['password'] == $password)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("location: /crms-project/admin-dashboard");
        }
        else {
            $errors['login'] = "Invalid username or password";
        }
    }
}

$_SESSION['errors'] = $errors;
header("Location: /crms-project/admin-login");
exit(); */

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
    header("Location: /crms-project/admin-login");
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
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {
            // Password is correct, start a new session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the dashboard
            header('Location: /crms-project/admin-dashboard');
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
    header("Location: /crms-project/admin-login");
    exit();
}

