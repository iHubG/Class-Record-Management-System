$(document).ready(function() {
    // Handle form submission using AJAX
    $('#registerForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('#registerForm .text-danger').text('');

        // Validate form fields
        var name = $('#name').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var errors = {};

        // Validate name
        if (!name.trim()) {
            errors['name'] = "Name is required";
        } else if (!/^[a-zA-Z-' ]*$/.test(name)) {
            errors['name'] = "Only letters and white space allowed";

        }

        // Validate username
        if (!username.trim()) {
            errors['username'] = "Username is required";
        }

        // Validate password
        if (!password.trim()) {
            errors['password'] = "Password is required";
        } else if (password.length < 8) {
            errors['password'] = "Password must be at least 8 characters long";
        }

        // If there are validation errors, display them
        if (Object.keys(errors).length > 0) {
            displayErrors(errors);
        } else {
            // If no validation errors, submit the form via AJAX
            $.ajax({
                type: 'POST',
                url: '/crms-project/instructor-registration', // PHP script for form handling
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Handle success response
                    console.log('Response:', response);
                    // Display success message below the password field
                    $('#password-error').html("<div class='text-success text-center mt-5'>Registration successful!</div>");

                    // Reload the page after a short delay (e.g., 1 second)
                    setTimeout(function() {
                        location.reload(); // Reload the current page
                    }, 1000); // 1000 milliseconds = 1 second
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    var response = xhr.responseJSON;
                    if (response) {
                        displayErrors(response);
                    } else {
                        console.error('Error:', error);
                        $('#password-error').html("<div class='text-danger text-center mt-5'>Instructor with the same name or username already exists</div>");
                    }
                }
            });
        }
    });
});

// Function to display validation errors
function displayErrors(errors) {
    $.each(errors, function(key, value) {
        $('#' + key + '-error').text(value);
    });
}