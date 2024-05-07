<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin-Instructor Dashboard</title>
    </head>
    <body>
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
                            <h4>Instructors</h4>
                            <i class="bi bi-person-circle fs-3"></i>
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