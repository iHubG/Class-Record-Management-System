<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Backup & Restore</title>
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
                        <a href="#" class="text-decoration-none text-white">
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="student-link">
                                <i class="bi bi-backpack2"></i>
                                <h5>Students</h5>           
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
                            <h4>Backup & Restore</h4>
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
                        
                    ?>
                    <div class="main-content-info">
                        <div class="container d-flex justify-content-center mt-5">
                            <form action="" method="post" id="backupForm">
                                <button type="submit" name="backup" class="btn btn-primary me-2" id="backupButton">Backup Database</button>
                            </form>

                            <form action="" method="post" id="restoreForm" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <input type="file" name="backup_file" id="backupFile" class="form-control" accept=".sql" required>
                                    <button type="submit" id="restoreButton" class="btn btn-success ms-2">Restore Database</button>
                                </div>
                            </form>
                        </div>   
                        <!-- Error message div -->
                        <div id="errorMessage" class="alert alert-danger" style="display: none;">Error occurred while processing the request.</div>

                        <!-- Success message div -->
                        <div id="successMessage" class="alert alert-success" style="display: none;">Backup Successful!</div>  

                        <!-- Success message div -->
                        <div id="restoreSuccessMessage" class="alert alert-success" style="display: none;">Restore Successful!</div>

                        <!-- Error message div -->
                        <div id="restoreErrorMessage" class="alert alert-danger" style="display: none;">Error occurred during restore process.</div>

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


            document.getElementById("backupButton").addEventListener("click", function() {
                // Confirm backup action with the user
                if (!confirm("Are you sure you want to backup the database?")) {
                    return; // Exit the function if the user cancels the action
                }

                // Send AJAX request to backup.php
                $.ajax({
                    url: "/crms-project/admin-backup",
                    type: "POST",
                    success: function(response) {
                        // Show success message after backup
                        $("#successMessage").show();
                        // Hide success message after 2 seconds
                        setTimeout(function() {
                            $("#successMessage").hide();                      
                        },3000);
                    },
                    error: function(xhr, status, error) {
                        // Hide success message if previously shown
                        $("#successMessage").hide();
                        // Show error message
                        $("#errorMessage").show();
                        console.error(error);
                    }
                });
            });


            document.getElementById("restoreButton").addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default form submission

                // Check if a file is selected
                var file = $("#backupFile")[0].files[0];
                if (!file) {
                    // Show error message if no file is selected
                    $("#restoreErrorMessage").text("Please select a file for restoration.").show();
                    setTimeout(function() {
                            $("#restoreErrorMessage").hide();
                    }, 3000);
                    return; // Exit the function
                }

                // Create FormData object to send file data
                var formData = new FormData();
                formData.append("backup_file", file);

                $.ajax({
                    url: "/crms-project/admin-restore", // Path to your restore.php file
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Response:', response);                 
                        // Show success message only if the response indicates success
                        $("#restoreSuccessMessage").show();
                        // Hide success message after 3 seconds
                        setTimeout(function() {
                            $("#restoreSuccessMessage").hide();
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        $("#restoreErrorMessage").show();
                        setTimeout(function() {
                            $("#restoreErrorMessage").hide();
                        }, 3000);
                        console.error(error);
                    }
                });
            });

        </script>
    </body>
</html>