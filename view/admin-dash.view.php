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
                                    function get_admin_profile_picture($adminId) {
                                    // Assuming you have a function to connect to the database
                                    require ('./config/db.php');
                                
                                    // Prepare the SQL query to retrieve the profile picture
                                    $sql = 'SELECT `profile_picture` FROM `admin` WHERE `id` = ?';
                                    $stmt = $pdo->prepare($sql);
                                    
                                    // Execute the query with the provided admin ID
                                    $stmt->execute([$adminId]);
                                    
                                    // Fetch the result
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    
                                    // Check if a profile picture exists for the admin
                                    if ($result && $result['profile_picture']) {
                                        // Return the profile picture data
                                        return $result['profile_picture'];
                                    } else {
                                        // Return null if no picture is found
                                        return null;
                                    }
                                    }                                    
                                    
                                    if (isset($_SESSION['admin_id'])) {
                                        $adminId = $_SESSION['admin_id'];
                                        // Proceed with operations that require admin_id
                                    } else {
                                        // Handle the case where admin_id is not set
                                        // Redirect to login page or show an error message
                                    }
                                    // Assuming you have a function to retrieve the profile picture
                                    $profilePicture = get_admin_profile_picture($_SESSION['admin_id']);
                                    if ($profilePicture) {
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($profilePicture) . '" alt="Profile Picture" width="100">';
                                    } else {
                                        echo '<i class="bi bi-person-circle fs-3" data-bs-toggle="modal" data-bs-target="#admin-ins-logo" id="admin-prof-logo"></i>';
                                    }
                                    ?>
                                    
                                    
                                    <h2><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <!-- Profile Picture Form -->
                                <form action="./controller/admin-profile-pict.php" method="post" enctype="multipart/form-data">
                                    <!-- Display existing profile picture (if available) -->
                                    
                                    <br>
                                    <input type="file" name="profile_picture" accept=".jpg, .jpeg, .png">
                                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">
                                    <input type="submit" class="btn btn-primary" value="Save changes">
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
                            <h4>Welcome Admin <?php echo htmlspecialchars($_SESSION['username']);  ?>!</h4>
                            <i class="bi bi-person-circle fs-3" data-bs-toggle="modal" data-bs-target="#admin-account" id="add-logo"></i>
                        </div>  
                    </nav>
                    <div class="main-content-info">
                        <div class="row g-0 py-5 justify-content-around">
                            <div class="col-3 shadow bg-white rounded p-5 text-center">
                                <div class="d-flex justify-content-around align-items-baseline">
                                    <h5 class="text-muted">Total Users</h5>         
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <h2>200</h2>
                            </div>
                            <div class="col-3 shadow bg-white rounded p-5 text-center">
                                <div class="d-flex justify-content-around align-items-baseline">
                                    <h5 class="text-muted">Instructors</h5>         
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <h2>20</h2>
                            </div>
                            <div class="col-3 shadow bg-white rounded p-5 text-center">
                                <div class="d-flex justify-content-around align-items-baseline">
                                    <h5 class="text-muted">Students</h5>         
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <h2>180</h2>
                            </div>
                        </div>
                    </div>

<!-- Success message for upload -->
<?php if(isset($uploadMessages['upload'])): ?>
    <div class="my-2 mt-xxl-3 text-center">
        <div class="text-success">
            <?php echo $uploadMessages['upload']; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Error message for upload failure -->
<?php if(isset($uploadErrors['upload'])): ?>
    <div class="my-2 mt-xxl-3 text-center">
        <div class="text-danger">
            <?php echo $uploadErrors['upload']; ?>
        </div>
    </div>
<?php endif; ?>

                </div>
            </div>
        </section>
    </body>
</html>