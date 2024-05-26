<?php
$dbHost = 'localhost';
$dbName = 'crms_project';
$dbUsername = 'root';
$dbPassword = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUsername, $dbPassword);
    
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perform a simple query to verify the connection
    $stmt = $pdo->query("SELECT 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo "";
    } else {
        echo "Connection failed: Unable to fetch data";
    }
} catch (PDOException $e) {
    // Handle connection errors more gracefully
    echo "Connection failed: " . $e->getMessage();
}

