<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['instructor_id'])) {
        header('Location: /crms-project/instructor-login');
        exit();
    }

    // Get the username from the session
    $username = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Instructor';

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
                            
                            <form action="">
                                <input type="text" class="form-control my-3" name="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>">
                                <select class="form-select" aria-label="Department">
                                    <option selected>Select a Department</option>
                                    <option value="SAS">SAS</option>
                                    <option value="EDUC">EDUC</option>
                                    <option value="CBM">CBM</option>
                                    <option value="CCSICT">CCSICT</option>
                                    <option value="IAT">IAT</option>
                                    <option value="PS">PS</option>
                                    <option value="CCJE">CCJE</option>
                                </select>
                                <input type="submit" class="btn btn-primary mt-3 w-100" value="Update Profile">
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