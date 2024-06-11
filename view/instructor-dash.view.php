<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['instructor_id'])) {
        header('Location: /crms-project/instructor-login');
        exit();
    }

    // Get the name from the session
    $name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Instructor';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Instructor Dashboard</title>
    </head>
    <body>
        <!-- Instructor Account Modal -->
        <div class="modal fade" id="instructor-account" tabindex="-1" aria-labelledby="instructor-account" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="instructor-account">Instructor <?php echo htmlspecialchars($_SESSION['name']); ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-5 text-center">
                            <?php
                                                
                                $instructorId = $_SESSION['instructor_id'];
                            
                                // Require database connection
                                require './config/db.php';
                            
                                // Retrieve profile picture filename from the database
                                $sql = 'SELECT profile_picture_filename FROM instructor WHERE id = ?';
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([$instructorId]);
                                $profilePictureFileName = $stmt->fetchColumn();
                            
                                // If profile picture filename is found, construct image path and display the image
                                if ($profilePictureFileName) {
                                    $imagePath = "/crms-project/uploads-instructors/" . $profilePictureFileName; // Adjust path as necessary
                                    echo '<img src="' . $imagePath . '" alt="Profile Picture" width="150" height="150">';
                                } else {
                                    // If no profile picture is found, display a default image or placeholder
                                    echo '<i class="bi bi-person-circle fs-1 img-thumbnail px-5" id="profilePlaceholder"></i>';
                                }
                                
                            ?>   
                            
                            <?php

                                // Retrieve the instructor's name from the database
                                $query = "SELECT name FROM Instructor WHERE id = :id";
                                $statement = $pdo->prepare($query);
                                $statement->execute(array(':id' => $_SESSION['instructor_id']));
                                $instructor = $statement->fetch(PDO::FETCH_ASSOC);

                                // Check if the instructor is found in the database
                                if ($instructor) {
                                    $instructorName = $instructor['name'];
                                } else {
                                    // Handle the case where the instructor is not found
                                    $instructorName = 'Instructor Not Found';
                                }

                                $instructorID = $_SESSION['instructor_id'];
                                $query = "SELECT department FROM Instructor WHERE id = :id";
                                $statement = $pdo->prepare($query);
                                $statement->execute(array(':id' => $instructorID));
                                $instructor = $statement->fetch(PDO::FETCH_ASSOC);

                                // Store the department information in a session variable
                                if ($instructor && isset($instructor['department'])) {
                                    $_SESSION['department'] = $instructor['department'];
                                }

                            ?>
                            
                            <form id="updateProfileForm" method="post">
                                <!-- Input field for instructor's name with error message -->
                                <div class="mb-3 mt-3">
                                    <input type="text" class="form-control" id="nameInput" name="name" value="<?php echo htmlspecialchars($instructorName); ?>" autocomplete="off">
                                    <div id="nameError" class="text-danger"></div>
                                </div>
                                
                                <!-- Select field for selecting a department with error message -->
                                <div class="mb-3">
                                    <select class="form-select" aria-label="Department" name="department" id="departmentSelect">
                                        <option value="" selected>Select a Department</option>
                                        <option value="SAS"<?php if (isset($_SESSION['department']) && $_SESSION['department'] == 'SAS') echo ' selected'; ?>>SAS</option>
                                        <option value="EDUC"<?php if (isset($_SESSION['department']) && $_SESSION['department'] == 'EDUC') echo ' selected'; ?>>EDUC</option>
                                        <option value="CBM"<?php if (isset($_SESSION['department']) && $_SESSION['department'] == 'CBM') echo ' selected'; ?>>CBM</option>
                                        <option value="CCSICT"<?php if (isset($_SESSION['department']) && $_SESSION['department'] == 'CCSICT') echo ' selected'; ?>>CCSICT</option>
                                        <option value="IAT"<?php if (isset($_SESSION['department']) && $_SESSION['department'] == 'IAT') echo ' selected'; ?>>IAT</option>
                                        <option value="PS"<?php if (isset($_SESSION['department']) && $_SESSION['department'] == 'PS') echo ' selected'; ?>>PS</option>
                                        <option value="CCJE"<?php if (isset($_SESSION['department']) && $_SESSION['department'] == 'CCJE') echo ' selected'; ?>>CCJE</option>
                                    </select>
                                    <div id="departmentError" class="text-danger"></div>
                                </div>

                                <!-- Error messages will be displayed here -->
                                <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>
                                <!-- Success message will be displayed here -->
                                <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary mt-3 w-100">Update Profile</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <!-- Profile Picture Form -->
                        <form action="/crms-project/instructor-profile-pict" method="post" enctype="multipart/form-data">                        
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="file" name="profile_picture" accept=".jpg, .jpeg, .png" required>
                                <input type="hidden" name="instructor_id" value="<?php echo $_SESSION['instructor_id']; ?>">
                                <input type="submit" class="btn btn-primary" value="Upload Picture">
                            </div>                                  
                        </form>
                        <hr class="bottom-rule">
                        <a href="/crms-project/instructor-logout" class="text-decoration-none text-white text-center border w-100 rounded" id="instructor-logout">
                            <div class="logout-nav d-flex justify-content-center gap-2 p-2">
                                <i class="bi bi-box-arrow-right"></i>
                                <h5>Log out</h5>
                            </div> 
                        </a> 
                    </div>
                </div>
            </div>
        </div>
        <section id="instructor-dash">
            <nav class="bg-success-subtle">
                <div class="container d-flex justify-content-between align-items-center p-3 ">
                    <h4>Instructor Dashboard</h4>
                    <?php 
                        if ($profilePictureFileName) {
                            $imagePath = "/crms-project/uploads-instructors/" . $profilePictureFileName; // Adjust path as necessary
                            echo '<img src="' . $imagePath . '" alt="Profile Picture" class="instructor-circle-logo border border-primary-subtle" data-bs-toggle="modal" data-bs-target="#instructor-account">';
                        } else {
                            // If no profile picture is found, display a default image or placeholder
                            echo '<i class="bi bi-person-circle fs-2" data-bs-toggle="modal" data-bs-target="#instructor-account" id="instructor-logo"></i>';
                        }
                    ?>
                </div>  
            </nav>
            <?php 
                // Fetch subjects for the current instructor
                $instructor_id = $_SESSION['instructor_id'];
                $stmt = $pdo->prepare("SELECT * FROM subjects WHERE instructor_id = :instructor_id");
                $stmt->execute(['instructor_id' => $instructor_id]);
                $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="container">
                <div class="row mt-5">
                    <?php foreach ($subjects as $subject): ?>
                        <div class="col-6 col-lg-3">
                            <a href="/crms-project/class-record?subject_id=<?php echo htmlspecialchars($subject['id']); ?>" class="cursor-pointer text-decoration-none">
                                <div class="card card-shadow">
                                    <div class="card" aria-hidden="true">
                                        <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="text-black"><?php echo htmlspecialchars($subject['subject_name']); ?></h5>
                                            <h5><?php echo htmlspecialchars($subject['subject_code']); ?></h5>
                                            <h6 class="text-secondary"><?php echo htmlspecialchars($subject['section']); ?></h6>
                                            <div class="d-flex justify-content-between">
                                                <a href="/crms-project/chat"><i class="bi bi-chat fs-4"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </a>                
                        </div>
                    <?php endforeach; ?>

                    <!-- Add Subject Button -->
                    <i class="bi bi-plus-circle my-5 fs-1 add-icon" data-bs-toggle="modal" data-bs-target="#subject"></i>

                    <!-- Subject Button Modal -->
                    <div class="modal fade" id="subject" tabindex="-1" aria-labelledby="subjectLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header border-0">
                                <h1 class="modal-title fs-5" id="subjectLabel">Add Subject</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addSubject" method="post">
                                    <small class="text-danger">Note: Use UPPERCASE for every first letter of the subject name, and all UPPERCASE for both the subject code and section.</small>
                                    <input id="subjectName" class="form-control mt-3" type="text" name="subjectName" placeholder="Subject Name" aria-label="subject name" autocomplete="off">
                                    <div id="subjectNameError" class="text-danger mb-3"></div>
                                    
                                    <input id="subjectCode" class="form-control" type="text" name="subjectCode" placeholder="Subject Code" aria-label="subject code" autocomplete="off">
                                    <div id="subjectCodeError" class="text-danger mb-3"></div>
                                    
                                    <input id="section" class="form-control" type="text" name="section" placeholder="Section" aria-label="section" autocomplete="off">
                                    <div id="sectionError" class="text-danger mb-3"></div>
                                    
                                    <div id="errorMessagesubject" class="text-danger mb-2 text-center" style="display: none;"></div> <!-- Error message container -->
                                    
                                    <div id="successMessagesubject" class="text-success mb-2 text-center" style="display: none;"></div> <!-- Success message container -->

                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary text-center" name="submit" onclick="handleFormSubmission();">Add</button>
                                    </div>
                                </form>                                                     
                            </div>
                            <div class="modal-footer border-0 d-flex justify-content-center">
                                
                            </div>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
        </section>
        <script>
             // Hide content until everything is loaded
             document.documentElement.style.visibility = "hidden";

            function showContent() {
                document.documentElement.style.visibility = "visible";
            }

            // Only apply delay if the page is initially loading
            if (document.readyState === "loading") {
                // Introduce a delay of 0.5 seconds before showing content
                setTimeout(showContent, 500); // Delay of 0.5 seconds (500 milliseconds)
            } else {
                // If the page is already loaded, immediately show the content
                showContent();
            }

            function showProfilePicture() {
                document.getElementById('profilePicture').classList.remove('d-none');
                document.getElementById('placeholderContainer').classList.add('d-none');
            }

           // Function to handle form submission
            function handleFormSubmission() {
                // Clear previous error messages
                document.querySelectorAll('.text-danger').forEach(function(element) {
                    element.textContent = '';
                });

                // Validate form fields
                var subjectName = document.getElementById('subjectName').value.trim();
                var subjectCode = document.getElementById('subjectCode').value.trim();
                var section = document.getElementById('section').value.trim();
                var isValid = true;

                if (!subjectName) {
                    document.getElementById('subjectNameError').textContent = 'Subject Name is required.';
                    isValid = false;
                }
                if (!subjectCode) {
                    document.getElementById('subjectCodeError').textContent = 'Subject Code is required.';
                    isValid = false;
                }
                if (!section) {
                    document.getElementById('sectionError').textContent = 'Section is required.';
                    isValid = false;
                }

                // If form is not valid, return
                if (!isValid) {
                    return;
                }

                // Serialize form data
                var formData = new FormData(document.getElementById('addSubject'));

                // Submit the form data via AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/crms-project/instructor-add-subject');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Display success message below the add button                
                        document.getElementById('successMessagesubject').innerHTML = 'Subject added successfully';
                        document.getElementById('successMessagesubject').style.display = 'block';
                        setTimeout(function() {
                            document.getElementById('successMessagesubject').innerHTML = ''; // Clear the success message
                            document.getElementById('successMessagesubject').style.display = 'none';                                
                            document.getElementById('addSubject').reset(); 
                            location.reload();
                        }, 1000);                       
                    } else {
                        // Handle error response
                        console.error('Error:', xhr.responseText);
                        // Display error message below the add button
                        document.getElementById('errorMessagesubject').textContent = xhr.responseText;
                        document.getElementById('errorMessagesubject').style.display = 'block';
                    }
                };
                xhr.onerror = function() {
                    // Handle network errors
                    console.error('Network Error');
                    // Display generic error message below the add button
                    document.getElementById('errorMessagesubject').textContent = 'Failed to add subject. Please try again later.';
                    document.getElementById('errorMessagesubject').style.display = 'block';
                };
                xhr.send(formData);
            }

        </script>
    </body>
</html>