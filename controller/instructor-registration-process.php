<?php  
session_start();

$errors = [];


// Validate fullname
if (empty($_POST['name'])) {
    $errors['name'] = "Name is required";
} else {
    $name = $_POST['name'];
}


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
    header("Location: /crms-project/admin-instructor-dash");
    exit(); // Exit immediately after redirection
}
