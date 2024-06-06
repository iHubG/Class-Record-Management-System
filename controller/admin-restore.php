<?php
// Function to restore database from SQL backup file
function restoreDatabase($pdo, $backupFilePath) {
    // Read SQL backup file
    $sql = file_get_contents($backupFilePath);
    
    // Execute SQL queries
    $pdo->exec($sql);
}

// Handle file upload and restore process
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["backup_file"])) {
    // Define upload directory
    $uploadDirectory = __DIR__ . '/../restore/';

    // Define allowed file types
    $allowedTypes = ['sql'];

    // Get file details
    $fileName = $_FILES["backup_file"]["name"];
    $fileTempName = $_FILES["backup_file"]["tmp_name"];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if file type is allowed
    if (!in_array($fileType, $allowedTypes)) {
        echo "Error: Only SQL files are allowed.";
        exit();
    }

    // Move uploaded file to the upload directory
    $uploadFilePath = $uploadDirectory . $fileName;
    if (!move_uploaded_file($fileTempName, $uploadFilePath)) {
        echo "Error: Failed to upload file.";
        exit();
    }

    try {
        // Restore database from backup file
        restoreDatabase($pdo, $uploadFilePath);

        echo "success";
    } catch (PDOException $e) {
        echo "Database restore failed: " . $e->getMessage();
    }
}

