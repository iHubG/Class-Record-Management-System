<?php
// Function to backup database
function backupDatabase($pdo, $backupFilePath) {
    // Fetch data from database tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $output = '';
    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT * FROM $table");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $pdo->query("SHOW CREATE TABLE $table");
        $createTable = $stmt->fetch(PDO::FETCH_ASSOC)['Create Table'];
        $output .= "$createTable;\n";
        foreach ($rows as $row) {
            $output .= "INSERT INTO `$table` VALUES (";
            foreach ($row as $value) {
                $output .= "'" . $pdo->quote($value) . "',";
            }
            $output = rtrim($output, ',') . ");\n";
        }
    }

    // Write data to backup file
    file_put_contents($backupFilePath, $output);
}

// Define backup folder path within the project directory
$backupFolderPath =  __DIR__ . '/../backup/';

// Ensure the backup folder exists, create it if necessary
if (!file_exists($backupFolderPath)) {
    mkdir($backupFolderPath, 0777, true);
}

// Define backup file path within the backup folder
// Add a timestamp to the backup file name to avoid overwriting existing backups
$backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
$backupFilePath = $backupFolderPath . $backupFileName;

// Trigger backup process when backup button is clicked
backupDatabase($pdo, $backupFilePath);

echo 'success';
