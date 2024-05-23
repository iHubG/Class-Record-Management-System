function deleteInstructor(instructorId) {
    // AJAX request to delete the instructor
    $.ajax({
        type: 'POST',
        url: '/crms-project/instructor-delete', // PHP script for deleting instructor
        data: { instructor_id: instructorId }, // Pass the instructor ID to be deleted
        success: function(response) {
            // Handle success response
            console.log('Instructor deletion response:', response);
            // Reload the page or update UI as needed
            location.reload(); // Reload the page after deletion
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error deleting instructor:', error);
            // Display error message if needed
        }
    });
}
