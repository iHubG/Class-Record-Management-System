<?php
// Function to restore database from SQL backup file
function restoreDatabase($pdo, $backupFilePath) {
    // Begin transaction
    $pdo->beginTransaction();

    // Read SQL backup file
    $sql = file_get_contents($backupFilePath);
    
    // Execute SQL queries
    try {
        $pdo->exec($sql);
        // Commit transaction
        $pdo->commit();
        return true; // Restoration successful
    } catch (PDOException $e) {
        // Rollback transaction on failure
        $pdo->rollBack();
        return false; // Restoration failed
    }
}


