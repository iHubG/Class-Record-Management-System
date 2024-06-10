<?php 
session_start();

// Assuming the student's ID is stored in the session
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

   // Prepare the SQL query to retrieve subject details for the student
   $sql = "SELECT subjects.id, subjects.subject_name, subjects.subject_code, subjects.section
        FROM class
        INNER JOIN subjects ON class.subject_id = subjects.id
        WHERE class.student_id = :student_id";

    // Prepare and execute the statement
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all rows as an associative array
    $student_subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Redirect to the login page if the student is not logged in
    header("Location: /crms-project/student-login");
    exit;
}

// Get student's first name and last name from session
$first_name = isset($_SESSION['first_name']) ? htmlspecialchars($_SESSION['first_name']) : '';
$last_name = isset($_SESSION['last_name']) ? htmlspecialchars($_SESSION['last_name']) : '';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Dashboard</title>
    </head>
    <body>
          <!-- student Account Modal -->
          <div class="modal fade" id="student-account" tabindex="-1" aria-labelledby="student-account" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="student-account">Student <?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ); ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-5 text-center">
                            <?php
                                                
                            
                                // Require database connection
                                require './config/db.php';
                            
                                // Retrieve profile picture filename from the database
                                $sql = 'SELECT profile_picture_filename FROM student WHERE id = ?';
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([$student_id]);
                                $profilePictureFileName = $stmt->fetchColumn();
                            
                                // If profile picture filename is found, construct image path and display the image
                                if ($profilePictureFileName) {
                                    $imagePath = "/crms-project/uploads-students/" . $profilePictureFileName; // Adjust path as necessary
                                    echo '<img src="' . $imagePath . '" alt="Profile Picture" width="150" height="150">';
                                } else {
                                    // If no profile picture is found, display a default image or placeholder
                                    echo '<i class="bi bi-person-circle fs-1 img-thumbnail px-5" id="profilePlaceholder"></i>';
                                }
                                
                            ?>   
                            
                            <?php

                                // Retrieve the student's name from the database
                                $query = "SELECT first_name, last_name, school_id, course, year_level FROM student WHERE id = :id";
                                $statement = $pdo->prepare($query);
                                $statement->execute(array(':id' => $_SESSION['student_id']));
                                $student = $statement->fetch(PDO::FETCH_ASSOC);

                                // Check if the student is found in the database
                                if ($student) {
                                    $firstName = $student['first_name'];
                                    $lastName = $student['last_name'];
                                    $schoolId = $student['school_id'];
                                    $course = $student['course'];
                                    $year = $student['year_level'];
                                } else {
                                    // Handle the case where the student is not found
                                    $firstName = 'Student Not Found';
                                    $lastName = '';
                                }
                            ?>

                            <form id="updateStudentForm" method="post">
                                <!-- Input field for student's first name with error message -->
                                <div class="mb-3 mt-3">
                                    <input type="text" class="form-control" id="firstNameInput" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="First Name" autocomplete="off">
                                    <div id="firstNameError" class="text-danger"></div>
                                </div>

                                <!-- Input field for student's last name with error message -->
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="lastNameInput" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Last Name" autocomplete="off">
                                    <div id="lastNameError" class="text-danger"></div>
                                </div>

                                <!-- School Id Number -->
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="schoolIdInput" name="schoolId" value="<?php echo htmlspecialchars($schoolId); ?>" placeholder="School Id Number" autocomplete="off">
                                    <div id="schoolIdError" class="text-danger"></div>
                                </div>

                                <!-- Course -->
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="courseInput" name="course" value="<?php echo htmlspecialchars($course); ?>" placeholder="Course (e.g., BSIT)" autocomplete="off">
                                    <div id="courseError" class="text-danger"></div>
                                </div>

                                <!-- Year -->                             
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="yearInput" name="year" value="<?php echo htmlspecialchars($year); ?>" placeholder="Year (e.g., 3)" autocomplete="off">
                                    <div id="yearError" class="text-danger"></div>
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
                        <form action="/crms-project/student-profile-pict" method="post" enctype="multipart/form-data">                        
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="file" name="profile_picture" accept=".jpg, .jpeg, .png" required>
                                <input type="hidden" name="student_id" value="<?php echo $_SESSION['student_id']; ?>">
                                <input type="submit" class="btn btn-primary" value="Upload Picture">
                            </div>                                  
                        </form>
                        <hr class="bottom-rule">
                        <a href="/crms-project/student-logout" class="text-decoration-none text-white text-center border w-100 rounded" id="student-logout">
                            <div class="logout-nav d-flex justify-content-center gap-2 p-2">
                                <i class="bi bi-box-arrow-right"></i>
                                <h5>Log out</h5>
                            </div> 
                        </a> 
                    </div>
                </div>
            </div>
        </div>
        <section id="student-dash">
            <nav class="bg-success-subtle">
                <div class="container d-flex justify-content-between align-items-center p-3 ">
                    <h4>Student Dashboard</h4>
                    <?php 
                        if ($profilePictureFileName) {
                            $imagePath = "/crms-project/uploads-students/" . $profilePictureFileName; // Adjust path as necessary
                            echo '<img src="' . $imagePath . '" alt="Profile Picture" class="student-circle-logo border border-primary-subtle" data-bs-toggle="modal" data-bs-target="#student-account">';
                        } else {
                            // If no profile picture is found, display a default image or placeholder
                            echo '<i class="bi bi-person-circle fs-2" data-bs-toggle="modal" data-bs-target="#student-account" id="student-logo"></i>';
                        }
                    ?>
                </div>  
            </nav>
            <div class="container">
                <div class="row mt-5">
                    <?php foreach ($student_subjects as $subject): ?>
                        <div class="col-6 col-lg-3">
                            <a href="/crms-project/student-grading-sheets?subject_id=<?php echo htmlspecialchars($subject['id']); ?>" class="cursor-pointer text-decoration-none">
                                <div class="card card-shadow">
                                    <div class="card" aria-hidden="true">
                                        <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="text-black"><?php echo htmlspecialchars($subject['subject_name']); ?></h5>
                                            <h5><?php echo htmlspecialchars($subject['subject_code']); ?></h5>
                                            <h6 class="text-secondary"><?php echo htmlspecialchars($subject['section']); ?></h6>
                                            <div class="d-flex justify-content-between">
                                                <a href="/student-dashboard/chat"><i class="bi bi-chat fs-4"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </a>                
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </body>
</html>