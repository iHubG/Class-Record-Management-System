<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Instructor Class</title>
    </head>
    <body id="login-body">
        <section id="admin-dash">
            <div class="row g-0">
                <!-- Sidebar -->
                <div class="col-0 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block col-lg-2 d-flex p-3 p-xxl-4 px-2 flex-column" id="admin-sidebar">                   
                    <h2 class="h4 text-center">Admin</h2>
                    <nav id="dash-nav">
                        <div class="dash-nav d-flex gap-2 mt-5 p-2 rounded">
                            <i class="bi bi-house"></i>
                            <a href="/crms-project/admin-login-process" class="text-decoration-none text-white"><h5>Dashboard</h5></a>              
                        </div>
                        <div class="dash-nav d-flex gap-2 my-1 p-2 rounded">
                            <i class="bi bi-book"></i>
                            <a href="/crms-project/admin-instructor-dash" class="text-decoration-none text-white"><h5>Instructors</h5></a>              
                        </div>
                        <div class="dash-nav d-flex gap-2 my-1 p-2 rounded">
                            <i class="bi bi-backpack2"></i>
                            <a href="#" class="text-decoration-none text-white"><h5>Students</h5></a>              
                        </div>
                        <div class="logout-nav d-flex justify-content-center gap-2 my-4 p-2 rounded position-absolute bottom-0 start-0">
                            <i class="bi bi-box-arrow-right"></i>
                            <a href="/crms-project/" class="text-decoration-none text-white"><h5>Log out</h5></a>
                        </div>
                    </nav>
                </div>

                <!-- OffCanvas -->
                <div class="offcanvas offcanvas-start w-50" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-center m-auto" id="offcanvasScrollingLabel">Admin</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <nav id="dash-nav">
                            <div class="dash-nav d-flex gap-2 mt-5 p-2 rounded">
                                <i class="bi bi-house"></i>
                                <a href="/crms-project/admin-login-process" class="text-decoration-none text-white"><h5>Dashboard</h5></a>              
                            </div>
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded">
                                <i class="bi bi-book"></i>
                                <a href="/crms-project/admin-instructor-dash" class="text-decoration-none text-white"><h5>Instructors</h5></a>              
                            </div>
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded">
                                <i class="bi bi-backpack2"></i>
                                <a href="#" class="text-decoration-none text-white"><h5>Students</h5></a>              
                            </div>
                            <div class="logout-nav d-flex justify-content-center gap-2 my-4 p-2 rounded position-absolute bottom-0 start-0">
                                <i class="bi bi-box-arrow-right"></i>
                                <a href="/crms-project/" class="text-decoration-none text-white"><h5>Log out</h5></a>
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-12 col-lg-10 offset-lg-2" id="admin-main-content">
                    <nav class="bg-success-subtle">
                        <div class="d-flex justify-content-between align-items-center p-3 px-3 ">
                            <i class="bi bi-list d-lg-none d-xl-block d-xl-none d-xxl-block d-xxl-none fs-3 pe-auto" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" id="burger-menu"></i>
                            <h4>Classes</h4>
                            <i class="bi bi-person-circle fs-3"></i>
                        </div>  
                    </nav>
                    <div class="main-content-info container-fluid p-5">
                        <div class="row g-5 d-flex justify-content-between">
                            <div class="col-3 col-xl-4 col-lg-6 col-xxl-3">
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
                                            <a class="btn btn-primary disabled placeholder fs-6" aria-disabled="true">Cloud Computing</a>
                                            <i class="bi bi-chat fs-4"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-xl-4 col-lg-6 col-xxl-3">
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
                                            <a class="btn btn-primary disabled placeholder fs-6" aria-disabled="true">Game Developmment</a>
                                            <i class="bi bi-chat fs-4"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-xl-4 col-lg-6 col-xxl-3">
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
                                            <a class="btn btn-primary disabled placeholder fs-6" aria-disabled="true">Application Development</a>
                                            <i class="bi bi-chat fs-4"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-xl-4 col-lg-6 col-xxl-3">
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
                                            <a class="btn btn-primary disabled placeholder fs-6" aria-disabled="true">Programming</a>
                                            <i class="bi bi-chat fs-4"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     


                        <!-- Modal -->
                        <div class="modal fade" id="admin-ins-logo" tabindex="-1" aria-labelledby="admin-ins-label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="admin-ins-label">Instructor</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <i class="bi bi-person-circle fs-1"></i>                          
                                </div>
                                <div class="modal-footer d-flex justify-content-around">
                                    <a href="/crms-project/admin-instructor-class" class="btn btn-primary">View Classes</a>
                                    <a href="#" class="btn btn-danger">Delete Account</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Prof Icon -->
                    <i class="bi bi-plus-circle text-end my-5 mx-2 fs-1 fixed-bottom z-1"></i>

                </div>
            </div>
        </section>
    </body>
</html>