<?php 

$adminUsername = 'ianmacalinao2';
$adminPassword = 'Forcrms_project';

// Hash the password
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

try {
    // Prepare the SQL statement
    $stmt = $pdo->prepare('INSERT INTO admin (username, password) VALUES (:username, :password)');
    // Execute the statement with the provided values
    $stmt->execute(['username' => $adminUsername, 'password' => $hashedPassword]);
} catch (PDOException $e) {
    die("Error creating admin account: " . $e->getMessage());
}
