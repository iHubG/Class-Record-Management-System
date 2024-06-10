$(document).ready(function() {
    // Handle form submission using AJAX
    $('#registerStudent').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('#registerStudent .text-danger').text('');

        // Validate form fields
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var errors = {};

        // Validate first name
        if (!fname.trim()) {
            errors['fname'] = "First Name is required";
        } else if (!/^[a-zA-Z-' ]*$/.test(fname)) {
            errors['fname'] = "Only letters and white space allowed";

        }

         // Validate last name
         if (!lname.trim()) {
            errors['lname'] = "last Name is required";
        } else if (!/^[a-zA-Z-' ]*$/.test(lname)) {
            errors['lname'] = "Only letters and white space allowed";

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
                url: '/crms-project/student-registration', // PHP script for form handling
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Handle success response
                    //console.log('Response:', response);
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
                        $('#password-error').html("<div class='text-danger text-center mt-5'>Student with this username already registered and enrolled in this subject.</div>");
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


// Add Student
$(document).ready(function() {
    // Handle form submission using AJAX
    $('#addStudent').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('#addStudent .text-danger').text('');

        // Validate form fields
        var username = $('#usernameAdd').val();
        var errors = {};

        // Validate username
        if (!username.trim()) {
            errors['usernameAdd'] = "Username is required";
        }

        // If there are validation errors, display them
        if (Object.keys(errors).length > 0) {
            displayErrors(errors);
        } else {
            // If no validation errors, submit the form via AJAX
            $.ajax({
                type: 'POST',
                url: '/crms-project/student-add-subject', // PHP script for form handling
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Handle success response
                    $('#add-validation').html("<div class='text-success text-center mt-5'>Added successfully!</div>");
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
                        // Display a generic error message
                        $('#add-validation').html("<div class='text-danger text-center mt-5'>Student with this username doesn't exist or is already enrolled.</div>");
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



// Update Student Profile
//Update Profile

$(document).ready(function() {
    // Handle form submission using AJAX
    $('#updateStudentForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Clear previous error messages
        $('#errorMessages').hide().empty();

        // Validate form fields
        var fname = $('#firstNameInput').val();
        var lname = $('#lastNameInput').val();
        var schoolId = $('#schoolIdInput').val();
        var course = $('#courseInput').val();
        var year = $('#yearInput').val();
        var errors = {};

        // Validate first name
        if (!fname.trim()) {
            errors['firstName'] = "First Name is required";
        } else if (!/^[a-zA-Z-' ]*$/.test(fname)) {
            errors['firstName'] = "Only letters and white space allowed";
        } else {
            // Clear name error if valid
            $('#firstNameError').empty();
        }

        // Validate last name
        if (!lname.trim()) {
            errors['lastName'] = "Last Name is required";
        } else if (!/^[a-zA-Z-' ]*$/.test(lname)) {
            errors['lastName'] = "Only letters and white space allowed";
        } else {
            // Clear name error if valid
            $('#lastNameError').empty();
        }
        
        // Validate school id
        if (!schoolId.trim()) {
            errors['schoolId'] = "School ID is required";
        } else if (!/^[a-zA-Z0-9-]*$/.test(schoolId)) {
            errors['schoolId'] = "Only letters, numbers, and dashes are allowed";
        } else {
            // Clear error message if valid
            $('#schoolIdError').empty();
        }


        // Validate course
        if (!course.trim()) {
            errors['course'] = "Course is required";
        } else if (!/^[a-zA-Z-' ]*$/.test(course)) {
            errors['course'] = "Only letters and white space allowed";
        } else {
            // Clear name error if valid
            $('#courseError').empty();
        }

        // Validate year
        if (!year.trim()) {
            errors['year'] = "Year is required";
        } else if (!/^\d+$/.test(year)) {
            errors['year'] = "Only numbers are allowed";
        } else {
            // Clear error message if valid
            $('#yearError').empty();
        }


        // If there are validation errors, display them
        if (Object.keys(errors).length > 0) {
            displayErrors1(errors);
        } else {
            // If no validation errors, submit the form via AJAX
            $.ajax({
                type: 'POST',
                url: '/crms-project/student-update-profile', // PHP script for form handling
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Handle success response
                    console.log('Response:', response);
                    $('#successMessage').html('Profile updated successfully').show();
                    // Clear error messages upon success
                    $('#errorMessages').hide().empty();
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
                        $('#errorMessages').html('An error occurred while updating the profile.').show();
                    }
                }
            });
        }
    });
});

// Function to display validation errors
function displayErrors1(errors) {
    // Clear existing error messages
    $('#errorMessages').hide().empty();

    // Display new error messages
    $.each(errors, function(key, value) {
        $('#' + key + 'Error').text(value);
    });
}