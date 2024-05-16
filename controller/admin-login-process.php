<?php 
session_start();

/*

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Include your PDO connection script here

    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    try {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, start a new session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the dashboard
            header('Location: /crms-project/admin-dashboard');
            exit();
        } else {
            echo "<script language='javascript'>";
            echo "alert('Invalid username or password')";
            echo "</script>";
            die();
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "<script language='javascript'>";
        echo "alert('An error occurred: " . $e->getMessage() . "')";
        echo "</script>";
        die();
    }
}*/

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
            echo "<script language='javascript'>";
            echo "alert('WRONG INFORMATION')";
            echo "</script>";
            die();
        }
    }
}
