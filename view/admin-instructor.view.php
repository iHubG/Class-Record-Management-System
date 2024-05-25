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
                            <h4>Instructors</h4>
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
                    <div class="main-content-info">
                        <div class="row mt-5 g-0 justify-content-center">
                            <div class="col-8 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search Instructor" aria-label="Search name" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="searchButton"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            </div>
                        </div>

                        <!-- Message to display when no results are found -->
                        <div id="noResultsMessage" class="mt-3 text-muted text-center" style="display: none;">No results found for "<span id="searchTerm"></span>".</div>

                        <?php 
                            $stmt = $pdo->query("SELECT * FROM instructor");
                            $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);                                                
                        ?>
                       
                     <!-- Display Instructors -->
                    <div class="container-lg mt-5">
                        <div class="row g-0 py-1 px-1 justify-content-center" id="instructorContainer">
                            <?php foreach ($instructors as $instructor): ?>
                                <div class="col-5 col-sm-5 col-md-3 col-xxl-2 instructor-card shadow bg-white rounded p-5 px-3 text-center mx-3 my-3" id="instructor_<?php echo htmlspecialchars($instructor['id']); ?>">
                                    <!-- Icon or Profile Picture to trigger modal -->
                                    <?php if ($instructor['profile_picture_filename']): ?>
                                        <img src="/crms-project/uploads-instructors/<?php echo htmlspecialchars($instructor['profile_picture_filename']); ?>" alt="Instructor Picture" class="instructor-circle-logo border border-dark" data-bs-toggle="modal" data-bs-target="#admin-ins-logo">
                                    <?php else: ?>
                                        <i class="bi bi-person-circle fs-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#admin-ins-logo"></i>
                                    <?php endif; ?>                                                                
                                    <h5 class="mt-2 fs-5"><?php echo htmlspecialchars($instructor['name']); ?></h5>
                                    <input type="hidden" id="profilePicture_<?php echo htmlspecialchars($instructor['id']); ?>" value="<?php echo htmlspecialchars($instructor['profile_picture_filename']); ?>">
                                </div>
                            <?php endforeach; ?>                                
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
                                    <div class="modal-body d-flex justify-content-center flex-column align-items-center">
                                        <i class="bi bi-person-circle fs-1" id="personCircleIcon"></i>
                                        
                                         <!-- Display instructor's picture -->
                                        <img src="" alt="Instructor Picture" id="instructorPicture" width="150" height="150">

                                        <h5 id="instructorNamePlaceholder" class="mt-2"></h5>
                                                                 
                                    </div>
                                    <div class="modal-footer d-flex justify-content-around border-0">
                                        <a href="/crms-project/admin-instructor-class" class="btn btn-primary">View Classes</a>
                                        <form action="/crms-project/instructor-delete" method="post">
                                            <input type="hidden" name="id_delete" id="instructorIdInput" value="<?php echo $instructor['id']; ?>">
                                            <input class="btn btn-danger" type="submit" name="delete" value="Delete Account"> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Prof Icon -->  
                    <i class="bi bi-plus-circle text-end my-5 mx-2 fs-1 add-icon" data-bs-toggle="modal" data-bs-target="#add-prof" id="add-logo"></i>
                   

                    <!-- Instructor Button Modal -->
                    <div class="modal fade" id="add-prof" tabindex="-1" aria-labelledby="add-prof" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="add-prof">Add Instructor</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="registerForm" method="post">

                                        <!-- Name -->
                                        <div class="mb-3">
                                            <div>
                                                <label for="name" class="form-label fw-bold">Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-person"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" autocomplete="off">
                                                </div>
                                            </div>
                                            <div id="name-error" class="text-danger"></div>
                                        </div>

                                        <!-- Username -->
                                        <div class="mb-3">
                                            <div>
                                                <label for="username" class="form-label fw-bold">Username</label>
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
                                        <label for="password" class="form-label fw-bold">Password</label>
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

            // Search for Instructor
            document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("searchInput").addEventListener("input", function() {
                searchInstructors();
            });

            // Function to search instructors
            function searchInstructors() {
                const searchTerm = document.getElementById("searchInput").value.trim().toLowerCase();
                const instructorCards = document.querySelectorAll(".instructor-card");
                let found = false; // Variable to track if any results are found

                instructorCards.forEach(function(card) {
                    const instructorName = card.querySelector("h5").textContent.trim().toLowerCase();
                    if (searchTerm === "") {
                        card.style.display = "block"; // Show all cards if search term is empty
                        found = true; // Update found to true because there are results
                    } else if (instructorName.includes(searchTerm)) {
                        card.style.display = "block";
                        found = true;
                    } else {
                        card.style.display = "none";
                    }
                });

                // Display message when no results are found
                const noResultsMessage = document.getElementById("noResultsMessage");
                const searchTermSpan = document.getElementById("searchTerm");
                searchTermSpan.textContent = searchTerm;
                if (searchTerm === "") {
                    noResultsMessage.style.display = "none"; // Hide message when search term is empty
                } else if (!found) {
                    noResultsMessage.style.display = "block";
                } else {
                    noResultsMessage.style.display = "none";
                }
            }
            });


            document.addEventListener('DOMContentLoaded', function() {
                var instructorCards = document.querySelectorAll('.instructor-card');
                instructorCards.forEach(function(card) {
                    card.addEventListener('click', function() {
                        var instructorId = this.id.split('_')[1]; // Extract the instructor id from the card id
                        var instructorName = this.querySelector('h5').textContent; // Get the instructor's name from the h5 element
                        var profilePicture = document.getElementById('profilePicture_' + instructorId).value; // Get the profile picture filename using the instructor id
                        
                        console.log("Clicked on instructor card. Name:", instructorName, "Picture:", profilePicture);
                        
                        // Update instructor's name placeholder
                        document.getElementById('instructorNamePlaceholder').textContent = instructorName;
                        
                        // Update instructor's picture
                        var instructorPictureElement = document.getElementById('instructorPicture');
                        var personCircleIcon = document.getElementById('personCircleIcon');

                        if (profilePicture) {
                            instructorPictureElement.src = "/crms-project/uploads-instructors/" + profilePicture;
                            instructorPictureElement.alt = "Instructor Picture";
                            instructorPictureElement.style.display = "block"; // Show the image
                            personCircleIcon.style.display = "none"; // Hide the icon
                        } else {
                            instructorPictureElement.src = ""; // Set empty source if no picture available
                            instructorPictureElement.alt = ""; // Clear alt text
                            instructorPictureElement.style.display = "none"; // Hide the image
                            personCircleIcon.style.display = "block"; // Show the icon
                        }
                    });
                });
            });

        </script>                                                       
    </body>
</html>