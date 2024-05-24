<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['instructor_id'])) {
        header('Location: /crms-project/instructor-login');
        exit();
    }

    // Get the username from the session
    $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Instructor';

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
        <div class="modal fade" id="admin-account" tabindex="-1" aria-labelledby="admin-account" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="admin-account">Instructor <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-5 text-center">
                        <?php
                                /*                  
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
                                $imagePath = "/crms-project/uploads/" . $profilePictureFileName; // Adjust path as necessary
                                echo '<img src="' . $imagePath . '" alt="Profile Picture" width="150">';
                            } else {
                                // If no profile picture is found, display a default image or placeholder
                                echo '<i class="bi bi-person-circle fs-1"></i>';
                            }
                            */
                        ?>                                                                 
                            
                            <h2 class="mt-2 h3"><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <!-- Profile Picture Form -->
                        <form action="/crms-project/instructor-profile-pict" method="post" enctype="multipart/form-data">                        
                            <div class="d-flex justify-content-center">
                                <input type="file" name="profile_picture" accept=".jpg, .jpeg, .png" required>
                                <input type="hidden" name="instructor_id" value="<?php echo $_SESSION['instructor_id']; ?>">
                                <input type="submit" class="btn btn-primary" value="Update Profile">
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
                    <i class="bi bi-person-circle fs-1" data-bs-toggle="modal" data-bs-target="#admin-account" id="admin-prof-logo"></i>
                    <?php /*
                        if ($profilePictureFileName) {
                            $imagePath = "/crms-project/uploads/" . $profilePictureFileName; // Adjust path as necessary
                            echo '<img src="' . $imagePath . '" alt="Profile Picture" class="admin-circle-logo border border-primary-subtle" data-bs-toggle="modal" data-bs-target="#admin-account">';
                        } else {
                            // If no profile picture is found, display a default image or placeholder
                            echo '<i class="bi bi-person-circle fs-1" data-bs-toggle="modal" data-bs-target="#admin-account" id="admin-prof-logo"></i>';
                        }*/
                    ?>
                </div>  
            </nav>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-3">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="/crms-project/grading-sheets" class="btn btn-primary fs-6 cursor-pointer">Cloud Computing</a>
                                    <a href="/crms-project/chat"><i class="bi bi-chat fs-4"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true">Class 2</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true">Class 3</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true">Class 4</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 my-5">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true">Class 1</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 my-5">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true">Class 2</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 my-5">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true">Class 3</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 my-5">
                        <div class="card">
                            <div class="card" aria-hidden="true">
                            <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                                </p>
                                <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true">Class 4</a>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Instructor Button -->
                    <i class="bi bi-plus-circle my-5 fs-1 add-icon" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>

                    <!-- Instructor Button Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </body>
</html>