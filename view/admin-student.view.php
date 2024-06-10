<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Students</title>
    </head>
    <body id="login-body">
        <section id="admin-dash">
            <div class="row g-0">
                <!-- Sidebar -->
                <div class="col-0 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block col-lg-2 d-flex p-3 p-xxl-4 px-2 flex-column" id="admin-sidebar">                   
                    <h2 class="h4 text-center">Admin</h2>
                    <nav id="dash-nav">
                        <hr>
                        <a href="/crms-project/admin-dashboard" class="text-decoration-none text-white"> 
                            <div class="dash-nav d-flex gap-2 mt-2 p-2 rounded" id="dashboard-link">
                                <i class="bi bi-house"></i>
                                <h5>Dashboard</h5>
                            </div>
                        </a> 
                        <a href="/crms-project/admin-instructor-dash" class="text-decoration-none text-white">                              
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="instructor-link">
                                <i class="bi bi-book"></i>
                                <h5>Instructors</h5>           
                            </div>
                        </a>   
                        <a href="/crms-project/admin-student" class="text-decoration-none text-white">
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="student-link">
                                <i class="bi bi-backpack2"></i>
                                <h5>Students</h5>           
                            </div>
                        </a> 
                        <a href="/crms-project/admin-subject" class="text-decoration-none text-white">
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="subject-link">
                                <i class="bi bi-compass"></i>
                                <h5>Subjects</h5>           
                            </div>
                        </a>    
                        <a href="/crms-project/admin-activity-logs" class="text-decoration-none text-white">
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="activity-logs-link">
                                <i class="bi bi-activity"></i>
                                <h5>Activity Logs</h5>           
                            </div>
                        </a> 
                        <a href="/crms-project/admin-backup-restore" class="text-decoration-none text-white">
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="backup-restore-link">
                                <i class="bi bi-arrow-clockwise"></i>
                                <h5>Backup and Restore</h5>           
                            </div>
                        </a> 
                        <div class="logout-box rounded position-absolute bottom-0 start-0 d-flex justify-content-center align-items-center flex-column p-3 p-xxl-4 px-2">
                            <hr class="bottom-rule">
                            <a href="/crms-project/admin-logout" class="text-decoration-none text-white">
                                <div class="logout-nav d-flex justify-content-center gap-2 p-2">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <h5>Log out</h5>
                                </div> 
                            </a>                        
                        </div>
                    </nav>
                </div>

                <!-- OffCanvas -->
                <div class="offcanvas offcanvas-start w-50" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-center m-auto" id="offcanvasScrollingLabel">Admin</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="p-3 p-xxl-4 px-2">
                        <hr>
                    </div>
                    <div class="offcanvas-body">
                        <nav id="dash-nav">
                            <a href="/crms-project/admin-dashboard" class="text-decoration-none text-white"> 
                                <div class="dash-nav d-flex gap-2 mt-2 p-2 rounded" id="dashboard-link">
                                    <i class="bi bi-house"></i>
                                    <h5>Dashboard</h5>
                                </div>
                            </a> 
                            <a href="/crms-project/admin-instructor-dash" class="text-decoration-none text-white">                              
                                <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="instructor-link">
                                    <i class="bi bi-book"></i>
                                    <h5>Instructors</h5>           
                                </div>
                            </a>   
                            <a href="#" class="text-decoration-none text-white">
                                <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="student-link">
                                    <i class="bi bi-backpack2"></i>
                                    <h5>Students</h5>           
                                </div>
                            </a>   
                            <div class="logout-box rounded position-absolute bottom-0 start-0 d-flex justify-content-center align-items-center flex-column p-3 p-xxl-4 px-2">
                                <hr class="bottom-rule">
                                <a href="/crms-project/admin-logout" class="text-decoration-none text-white">
                                    <div class="logout-nav d-flex justify-content-center gap-2 p-2">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <h5>Log out</h5>
                                    </div> 
                                </a>                        
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Admin Account Modal -->
                <div class="modal fade" id="admin-account" tabindex="-1" aria-labelledby="admin-account" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h1 class="modal-title fs-5" id="admin-account">Admin <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="p-5 text-center">
                                    <?php
                                                        
                                        $adminId = $_SESSION['admin_id'];
                                    
                                        // Require database connection
                                        require './config/db.php';
                                    
                                        // Retrieve profile picture filename from the database
                                        $sql = 'SELECT profile_picture_filename FROM admin WHERE id = ?';
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute([$adminId]);
                                        $profilePictureFileName = $stmt->fetchColumn();
                                    
                                        // If profile picture filename is found, construct image path and display the image
                                        if ($profilePictureFileName) {
                                            $imagePath = "/crms-project/uploads-admin/" . $profilePictureFileName; // Adjust path as necessary
                                            echo '<img src="' . $imagePath . '" alt="Profile Picture" width="150" height="150">';
                                        } else {
                                            // If no profile picture is found, display a default image or placeholder
                                            echo '<i class="bi bi-person-circle fs-1 img-thumbnail px-5" id="profilePlaceholder"></i>';
                                        }
                                    ?>

                                    <!-- Placeholder for profile picture -->
                                    <div id="placeholderContainer" class="d-none">
                                        <i class="bi bi-person-circle fs-1 img-thumbnail"></i>
                                    </div>

                                    <h2 class="mt-2 h3"><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <!-- Profile Picture Form -->
                                <form action="/crms-project/admin-profile-pict" method="post" enctype="multipart/form-data">                        
                                    <div class="d-flex justify-content-center">
                                        <input type="file" name="profile_picture" accept=".jpg, .jpeg, .png" required>
                                        <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">
                                        <input type="submit" class="btn btn-primary" value="Update Profile">
                                    </div>                                  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

               
                <!-- Main Content -->
                <div class="col-12 col-lg-10 offset-lg-2" id="admin-main-content">
                    <nav class="bg-success-subtle">
                        <div class="d-flex justify-content-between align-items-center p-3 px-3 ">
                            <i class="bi bi-list d-lg-none d-xl-block d-xl-none d-xxl-block d-xxl-none fs-3 pe-auto" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" id="burger-menu"></i>
                            <h4>Students</h4>
                            <?php
                                if ($profilePictureFileName) {
                                    $imagePath = "/crms-project/uploads-admin/" . $profilePictureFileName; // Adjust path as necessary
                                    echo '<img src="' . $imagePath . '" alt="Profile Picture" class="admin-circle-logo border border-primary-subtle" data-bs-toggle="modal" data-bs-target="#admin-account">';
                                } else {
                                    // If no profile picture is found, display a default image or placeholder
                                    echo '<i class="bi bi-person-circle fs-2" data-bs-toggle="modal" data-bs-target="#admin-account" id="admin-prof-logo"></i>';
                                }
                            ?>
                        </div>  
                    </nav>
                    <?php 
                        // Prepare SQL query to retrieve all students
                        $sql_students = "SELECT id, school_id, first_name, last_name, course, year_level FROM student";

                        // Prepare and execute the statement to retrieve all students
                        $stmt_students = $pdo->query($sql_students);

                        // Fetch all students
                        $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="main-content-info">
                        <div class="container-fluid">
                            <div class="row mt-4 g-0 justify-content-center mb-3">
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
                            </div>

                            <!-- Message to display when no results are found -->
                            <div id="noResultsMessage" class="mt-3 mb-3 text-muted text-center" style="display: none;">No results found for "<span id="searchTerm"></span>".</div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Student ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Course</th>
                                                <th>Year</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="searchResults">
                                            <?php
                                            $rowNumber = 1;
                                            foreach ($students as $student) {
                                                echo "<tr id='row_$rowNumber'>"; // Add unique identifier to each row
                                                echo "<td>" . $rowNumber . "</td>";
                                                echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($student['school_id']) . "' readonly></td>";
                                                echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($student['first_name']) . "' readonly></td>";
                                                echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($student['last_name']) . "' readonly></td>";
                                                echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($student['course']) . "' readonly></td>";
                                                echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($student['year_level']) . "' readonly></td>";
                                                echo "<td>";
                                                // Edit button with primary color
                                                echo "<button class='btn btn-primary mx-1 edit-button' onclick='enableEditing($rowNumber)'>Edit</button>"; // Add onclick event
                                                // Update button with success color
                                                echo "<button class='btn btn-success mx-1'>Update</button>";
                                                // Delete button with danger color
                                                echo "<button class='btn btn-danger mx-1'>Delete</button>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $rowNumber++;
                                            }
                                            ?>

                                            <script>
                                                 // Delegate event handling for "Edit" buttons
                                                 document.addEventListener("click", function(event) {
                                                    var target = event.target;
                                                    if (target.classList.contains("edit-button")) {
                                                        var rowNumber = target.dataset.row; // Get the row number from data attribute
                                                        enableEditing(rowNumber);
                                                    }
                                                });

                                                // Function to enable editing for a specific row
                                                function enableEditing(rowNumber) {
                                                    // Get the row element
                                                    var row = document.getElementById('row_' + rowNumber);
                                                    if (row) { // Check if the row element exists
                                                        // Find all input fields within the row using querySelectorAll
                                                        var inputs = row.querySelectorAll('input[type="text"]');
                                                        // Toggle the readonly attribute for each input field
                                                        inputs.forEach(function(input) {
                                                            input.readOnly = !input.readOnly;
                                                        });
                                                    }
                                                }

                                                 // Function to perform live search
                                                function performSearch() {
                                                    var searchTerm = document.getElementById("searchInput").value.trim().toLowerCase();
                                                    var students = <?php echo json_encode($students); ?>; // Assuming $students contains the student data

                                                    // Filter students based on the search term
                                                    var filteredStudents = students.filter(function(student) {
                                                        return student.first_name.toLowerCase().includes(searchTerm) ||
                                                            student.last_name.toLowerCase().includes(searchTerm) ||
                                                            student.school_id.toLowerCase().includes(searchTerm) ||
                                                            student.course.toLowerCase().includes(searchTerm) ||
                                                            student.year_level.toString().includes(searchTerm);
                                                    });

                                                    // Display search results or no results message
                                                    var searchResultsContainer = document.getElementById("searchResults");
                                                    var noResultsMessage = document.getElementById("noResultsMessage");
                                                    if (filteredStudents.length > 0) {
                                                        // Clear previous search results
                                                        searchResultsContainer.innerHTML = "";
                                                        // Append search results to the table
                                                        filteredStudents.forEach(function(student, index) {
                                                            var rowNumber = index + 1;
                                                            var row = "<tr>" +
                                                                "<td>" + rowNumber + "</td>" +
                                                                "<td><input type='text' class='form-control' value='" + student.school_id + "' readonly></td>" +
                                                                "<td><input type='text' class='form-control' value='" + student.first_name + "' readonly></td>" +
                                                                "<td><input type='text' class='form-control' value='" + student.last_name + "' readonly></td>" +
                                                                "<td><input type='text' class='form-control' value='" + student.course + "' readonly></td>" +
                                                                "<td><input type='text' class='form-control' value='" + student.year_level + "' readonly></td>" +
                                                                "<td>" +
                                                                    "<button class='btn btn-primary mx-1 edit-button' data-row='" + rowNumber + "'>Edit</button>" +
                                                                    "<button class='btn btn-success mx-1'>Update</button>" +
                                                                    "<button class='btn btn-danger mx-1'>Delete</button>" +
                                                                "</td>" +
                                                            "</tr>";
                                                            searchResultsContainer.innerHTML += row;
                                                        });
                                                        // Hide the no results message
                                                        noResultsMessage.style.display = "none";
                                                    } else {
                                                        // Display no results message
                                                        noResultsMessage.innerHTML = "No results found for \"" + searchTerm + "\".";
                                                        noResultsMessage.style.display = "block";
                                                    }
                                                }

                                                // Event listener for live search
                                                document.getElementById("searchInput").addEventListener("input", function() {
                                                    performSearch();
                                                });
                                            </script>
                                        </tbody>
                                    </table>
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

        </script>
    </body>
</html>