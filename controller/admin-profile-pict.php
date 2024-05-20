<?php

// validate_upload.php
function validate_uploaded_file($file) {
    $maxFileSize = 25 * 1024 * 1024; // 25MB
    $allowedFileTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $errors = [];

    if ($file['size'] > $maxFileSize) {
        $errors[] = 'File too large. File must be less than 25 megabytes.';
    }

    if (!in_array($file['type'], $allowedFileTypes)) {
        $errors[] = 'Invalid file type. Only JPG and PNG types are accepted.';
    }

    return $errors;
}

/*
// upload_profile_picture.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $adminId = $_POST['admin_id']; // Get the admin ID from the form
    $errors = validate_uploaded_file($_FILES['profile_picture']); // Validate the file

    if (empty($errors)) {
        // No errors, proceed with file processing
        $fileData = file_get_contents($_FILES['profile_picture']['tmp_name']);
        require '../config/db.php'; // Connect to the database

        try {
            // Update the admin's profile picture
            $sql = 'UPDATE `admin` SET `profile_picture` = ? WHERE `id` = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$fileData, $adminId]);

            echo 'Profile picture updated successfully.';
            // Redirect to the admin dashboard or another appropriate page
            header('Location: /crms-project/admin-dashboard');
            exit;
        } catch (PDOException $e) {
            echo 'Failed to upload profile picture: ' . $e->getMessage();
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}*/


//working
/*
// validation.php
function validate_uploaded_file($file) {
    $maxFileSize = 25 * 1024 * 1024; // 25MB
    $allowedFileTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $errors = [];

    if ($file['size'] > $maxFileSize) {
        $errors[] = 'File too large. File must be less than 25 megabytes.';
    }

    if (!in_array($file['type'], $allowedFileTypes)) {
        $errors[] = 'Invalid file type. Only JPG and PNG types are accepted.';
    }

    return $errors;
}

// file_handling.php
function process_uploaded_file($file, $adminId) {
    require '../config/db.php'; // Connect to the database
    $fileData = file_get_contents($file['tmp_name']);

    try {
        $pdo->beginTransaction();

        // Update the admin's profile picture
        $sql = 'UPDATE `admin` SET `profile_picture` = ? WHERE `id` = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fileData, $adminId]);

        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log('Failed to upload profile picture: ' . $e->getMessage());
        return false;
    }
}

// upload_profile_picture.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $adminId = $_POST['admin_id']; // Get the admin ID from the form
    $errors = validate_uploaded_file($_FILES['profile_picture']); // Validate the file

    if (empty($errors)) {
        if (process_uploaded_file($_FILES['profile_picture'], $adminId)) {
            $_SESSION['success_message'] = 'Profile picture updated successfully.';
            // Redirect to the admin dashboard or another appropriate page
            header('Location: /crms-project/admin-dashboard');
            exit;
        } else {
            $_SESSION['error_message'] = 'Failed to upload profile picture. Please try again later.';
        }
    } else {
        $_SESSION['error_message'] = 'An error occurred while processing your request. Please try again later.';
        // Log detailed error messages for debugging
        foreach ($errors as $error) {
            error_log($error);
        }
    }
}
*/

/*
// Check if the form was submitted and the file was uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'], $_POST['admin_id'])) {
    $adminId = $_POST['admin_id'];
    $errors = validate_uploaded_file($_FILES['profile_picture']);

    if (empty($errors)) {
        // Define the target directory for uploads relative to the current script
        $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/crms-project/uploads/';
        // Create the uploads directory if it doesn't exist
    
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }
        // Sanitize the file name and create a unique file name to prevent overwriting
        $filename = basename($_FILES['profile_picture']['name']);
        $newFilename = uniqid() . '-' . $filename; // Prefix the file name with a unique ID
        $targetFile = $targetDirectory . $newFilename;
        $targetFile = filter_var($targetFile, FILTER_SANITIZE_URL);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
            // Include the database connection
            require '../config/db.php';

            // Update the admin's profile picture path in the database
            $sql = 'UPDATE `admin` SET `profile_picture` = ? WHERE `id` = ?';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$newFilename, $adminId])) {
                $_SESSION['upload_success'] = 'Profile picture updated successfully.';
            } else {
                $_SESSION['upload_error'] = 'Failed to update profile picture in the database.';
            }
        } else {
            $_SESSION['upload_error'] = 'Failed to move the uploaded file.';
        }
    } else {
        $_SESSION['upload_errors'] = $errors;
    }
    // Redirect to the admin dashboard
    header('Location: /crms-project/admin-dashboard');
    exit;
}*/


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'], $_POST['admin_id'])) {
    $adminId = $_POST['admin_id'];
    $errors = validate_uploaded_file($_FILES['profile_picture']);

    if (empty($errors)) {
        // Define the target directory for uploads relative to the current script
        $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/crms-project/uploads/';
        // Create the uploads directory if it doesn't exist
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }
        // Sanitize the file name and create a unique file name to prevent overwriting
        $filename = basename($_FILES['profile_picture']['name']);
        $newFilename = uniqid() . '-' . $filename; // Prefix the file name with a unique ID
        $targetFile = $targetDirectory . $newFilename;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
            // Include the database connection
            require '../config/db.php';

            // Update the admin's profile picture path in the database
            $sql = 'UPDATE `admin` SET `profile_picture` = ? WHERE `id` = ?';
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(['uploads/' . $newFilename, $adminId])) {
                $_SESSION['upload_success'] = 'Profile picture updated successfully.';
            } else {
                // Get error info from the database if update fails
                $errorInfo = $stmt->errorInfo();
                $_SESSION['upload_error'] = 'Database error: ' . htmlspecialchars($errorInfo[2]);
            }
        } else {
            $_SESSION['upload_error'] = 'Failed to move the uploaded file.';
        }
    } else {
        $_SESSION['upload_errors'] = $errors;
    }
    // Redirect to the admin dashboard after processing the upload
    header('Location: /crms-project/admin-dashboard');
    exit;
}







