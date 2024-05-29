<?php

// Check if the instructor ID parameter is provided
if (isset($_GET['id'])) {
    // Sanitize the instructor ID parameter
    $instructorId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute the SQL query to retrieve instructor information
    $stmt = $pdo->prepare("SELECT name, department FROM instructor WHERE id = ?");
    $stmt->execute([$instructorId]);

    // Fetch the instructor information
    $instructor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($instructor) {
        // Return the instructor information as JSON response
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $instructor]); // Output clean JSON
        exit; // Stop script execution after sending response
    } else {
        // If instructor not found, return an error response
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Instructor not found']); // Output clean JSON
        exit; // Stop script execution after sending response
    }
} else {
    // If instructor ID parameter is not provided, return an error response
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Instructor ID parameter is missing']); // Output clean JSON
    exit; // Stop script execution after sending response
}
?>
