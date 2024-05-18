<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Instructor</title>
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
                                <i class="bi bi-person-circle fs-3" data-bs-toggle="modal" data-bs-target="#admin-ins-logo" id="admin-prof-logo"></i>                               
                                <h2>Admin <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>


                <!-- Main Content -->
                <div class="col-12 col-lg-10 offset-lg-2" id="admin-main-content">
                    <nav class="bg-success-subtle">
                        <div class="d-flex justify-content-between align-items-center p-3 px-3 ">
                            <i class="bi bi-list d-lg-none d-xl-block d-xl-none d-xxl-block d-xxl-none fs-3 pe-auto" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" id="burger-menu"></i>
                            <h4>Instructors</h4>
                            <i class="bi bi-person-circle fs-3" data-bs-toggle="modal" data-bs-target="#admin-account" id="add-logo"></i>
                        </div>  
                    </nav>
                    <div class="main-content-info">
                        <div class="row mt-5 g-0 justify-content-center">
                            <div class="col-8 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Instructor" aria-label="Search name" aria-describedby="button-addon2">
                                    <div class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                       
                        <div class="row g-0 py-5 justify-content-around">
                            <div class="col-3 shadow bg-white rounded p-5 text-center">
                                <i class="bi bi-person-circle fs-3" data-bs-toggle="modal" data-bs-target="#admin-ins-logo" id="admin-prof-logo"></i>                               
                                <h2>Prof 1</h2>
                            </div>
                            <div class="col-3 shadow bg-white rounded p-5 text-center">
                                <i class="bi bi-person-circle fs-3" data-bs-toggle="modal" data-bs-target="#admin-ins-logo" id="admin-prof-logo"></i>                                                    
                                <h2>Prof 2</h2>
                            </div>
                            <div class="col-3 shadow bg-white rounded p-5 text-center">
                                <i class="bi bi-person-circle fs-3" data-bs-toggle="modal" data-bs-target="#admin-ins-logo" id="admin-prof-logo"></i>                                                                                            
                                <h2>Prof 3</h2>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="admin-ins-logo" tabindex="-1" aria-labelledby="admin-ins-label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="admin-ins-label">Instructor</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <i class="bi bi-person-circle fs-1"></i>                          
                                </div>
                                <div class="modal-footer d-flex justify-content-around border-0">
                                    <a href="/crms-project/admin-instructor-class" class="btn btn-primary">View Classes</a>
                                    <a href="#" class="btn btn-danger">Delete Account</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Prof Icon -->  
                    <i class="bi bi-plus-circle text-end my-5 mx-2 fs-1 add-icon" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add-logo"></i>
                   

                    <!-- Instructor Button Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header border-0">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Instructor</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/crms-project/instructor-login-process" method="post">

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">Name:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person-plus"></i>
                                            </span>
                                            <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : ''; ?>" placeholder="Fullname" autocomplete="off" required>
                                        </div>
                                        <?php if (!empty($errors['name'])): ?>
                                            <div class="text-danger"><?php echo $errors['name']; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email address:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope-at"></i>
                                            </span>
                                            <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>" placeholder="yourname@example.com" autocomplete="off" required>
                                        </div>
                                        <?php if (!empty($errors['email'])): ?>
                                            <div class="text-danger"><?php echo $errors['email']; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3 mb-lg-0 mb-xxl-3">
                                        <label for="password" class="form-label fw-bold">Password:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-key"></i>
                                            </span>
                                            <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" autocomplete="off" required>
                                        </div>

                                        <?php if (!empty($errors['password'])): ?>
                                            <div class="text-danger"><?php echo $errors['password']; ?></div>
                                        <?php elseif(isset($_POST['password']) && strlen($_POST['password']) < 8): ?>
                                            <div class="invalid-feedback">
                                                Password must be at least 8 characters long.
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Error message for login failure -->
                                    <?php if(isset($errors['login'])): ?>
                                        <div class="mb-3">
                                            <div class="text-danger">
                                                <?php echo $errors['login']; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="text-center">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary my-5 px-5">Register</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </body>
</html>