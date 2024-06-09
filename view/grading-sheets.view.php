<?php 
  session_start();
  // Check if the user is logged in
  if (!isset($_SESSION['instructor_id'])) {
      header('Location: /crms-project/instructor-login');
      exit();
  }
  
  // Ensure a subject ID is provided
  if (!isset($_GET['subject_id']) || !is_numeric($_GET['subject_id'])) {
      // Handle the case when no subject ID is provided
      echo "Please select a subject.";
      exit();
  }
  
  $subject_id = $_GET['subject_id'];
  $instructor_id = $_SESSION['instructor_id'];

  $_SESSION['subject_id'] = $subject_id;
  
  // Check if the selected subject belongs to the logged-in instructor
  $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = :subject_id AND instructor_id = :instructor_id");
  $stmt->execute(['subject_id' => $subject_id, 'instructor_id' => $instructor_id]);
  $subject = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if (!$subject) {
      // Handle the case when the subject does not belong to the instructor
      echo "You are not authorized to access this subject.";
      exit();
  }
  
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Class Record</title>
    </head>
    <body>
        <section id="grading-sheets">
            <a href="/crms-project/instructor-dashboard" class="text-black"><i class="bi bi-arrow-left-circle fs-1 ms-2 ms-lg-5 mt-5 cursor-pointer back" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Go back"  data-bs-custom-class="custom-tooltip"></i></a>
            <h2 class="text-center mt-3 mb-5"><?php echo htmlspecialchars($subject['subject_name'] . ' ' . $subject['section'] ); ?> Class Record</h2>

            <div class="container-fluid">
                <div class="d-flex justify-content-center gap-5 mb-3">
                    <a href="/crms-project/instructor-grading-sheets?subject_id=<?php echo htmlspecialchars($subject['id']); ?>" class="btn btn-success">Grading Sheets</a>
                    <div class="col-8 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search Student" aria-label="Search name" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="searchButton"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Register Student Button Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#register-student">Register Student</button>
                    <!-- Add Student Button Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-student">Add Student</button>
                </div>
                 <!-- Register Student Button Modal -->
                    <div class="modal fade" id="register-student" tabindex="-1" aria-labelledby="register-student" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="register-student">Register Student</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="registerStudent" method="post">

                                        <!-- First Name -->
                                        <div class="mb-3">
                                            <div>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-person"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off">
                                                </div>
                                            </div>
                                            <div id="fname-error" class="text-danger"></div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="mb-3">
                                            <div>                        
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-person"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" autocomplete="off">
                                                </div>
                                            </div>
                                            <div id="lname-error" class="text-danger"></div>
                                        </div>

                                        <!-- Username -->
                                        <div class="mb-3">
                                            <div>           
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-person-circle"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off">
                                                </div>
                                            </div>
                                            <div id="username-error" class="text-danger"></div>
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-lock"></i>
                                                </span>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">                                                                    
                                                <span class="input-group-text password-toggle-icon">
                                                    <i class="bi bi-eye" id="togglePassword"></i>
                                                </span>
                                            </div>
                                            <div id="password-error" class="text-danger"></div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" name="submit" value="Register" class="btn btn-primary my-5 px-5">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                    
                    </div>

                     <!-- Register Student Button Modal -->
                     <div class="modal fade" id="add-student" tabindex="-1" aria-labelledby="add-student" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="add-student">Add Student</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addStudent" method="post">
                    
                                        <!-- Username -->
                                        <div class="mb-3">
                                            <div>           
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-person-circle"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="usernameAdd" name="username" placeholder="Username" autocomplete="off">
                                                </div>
                                            </div>
                                            <div id="usernameAdd-error" class="text-danger"></div>
                                        </div>

                                        <div id="add-validation" class="text-danger"></div>
                                                                        
                                        <div class="text-center">
                                            <button type="submit" name="submit" value="Add" class="btn btn-primary my-5 px-5">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <?php 
                        // Query to retrieve student details for the given subject ID
                        $stmt = $pdo->prepare("SELECT student.first_name, student.last_name FROM student INNER JOIN class ON student.id = class.student_id WHERE class.subject_id = ?");
                        $stmt->execute([$subject_id]);

                        // Fetch student details from the database
                        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        echo "<table class='table table-striped'>";
                        echo "<thead class='thead-dark'>";
                        echo "<tr>
                                <th>#</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Attitude</th>
                                <th>Attendance</th>
                                <th>Recitation</th>
                                <th>Assignment</th>
                                <th>Quiz</th>
                                <th>Project</th>
                                <th>Prelim</th>
                                <th>Midterm</th>
                                <th>Final</th>
                                <th></th>
                            </tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        $rowNumber = 1;

                        foreach ($students as $student) {
                            echo "<tr>";
                            echo "<td>" . $rowNumber . "</td>";
                            echo "<td>" . $student['last_name'] . "</td>";
                            echo "<td>" . $student['first_name'] . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>";
                            // Edit button with primary color
                            echo "<button class='btn btn-primary mx-1'>Edit</button>";
                            // Update button with success color
                            echo "<button class='btn btn-success mx-1'>Update</button>";
                            // Delete button with danger color
                            echo "<button class='btn btn-danger mx-1'>Delete</button>";
                            echo "</td>";
                            echo "</tr>";

                            $rowNumber++;
                        }
                        echo "</tbody>";
                        echo "</table>";
                    ?>
            </div>
        </section>
    </body>
</html>