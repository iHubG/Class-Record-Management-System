<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['admin_id'])) {
        header('Location: /crms-project/admin-login');
        exit();
    }

    // Get the username from the session
    $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
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
                        <a href="#" class="text-decoration-none text-white">
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="student-link">
                                <i class="bi bi-activity"></i>
                                <h5>Activity Logs</h5>           
                            </div>
                        </a> 
                        <a href="#" class="text-decoration-none text-white">
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded" id="student-link">
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
                            <h4>Dashboard</h4>
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
                        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM instructor");
                        $totalInstructors = $stmt->fetchColumn(); 
                    ?>
                    <div class="main-content-info">
                        <div class="row g-0 py-2 px-2 justify-content-center">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 shadow bg-white rounded p-5 text-center mx-5 my-4">
                                <div class="d-flex justify-content-around align-items-baseline">
                                    <h5 class="text-muted">Total Users</h5>         
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <h2>186</h2>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 shadow bg-white rounded p-5 text-center mx-5 my-4">
                                <div class="d-flex justify-content-around align-items-baseline">
                                    <h5 class="text-muted">Instructors</h5>         
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <h2><?php echo htmlspecialchars($totalInstructors); ?></h2>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 shadow bg-white rounded p-5 text-center mx-5 my-4">
                                <div class="d-flex justify-content-around align-items-baseline">
                                    <h5 class="text-muted">Students</h5>         
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <h2>180</h2>
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