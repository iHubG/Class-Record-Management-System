<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
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
                            <a href="#" class="text-decoration-none text-white"><h5>Dashboard</h5></a>              
                        </div>
                        <div class="dash-nav d-flex gap-2 my-1 p-2 rounded">
                            <i class="bi bi-book"></i>
                            <a href="#" class="text-decoration-none text-white"><h5>Instructors</h5></a>              
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
                                <a href="#" class="text-decoration-none text-white"><h5>Dashboard</h5></a>              
                            </div>
                            <div class="dash-nav d-flex gap-2 my-1 p-2 rounded">
                                <i class="bi bi-book"></i>
                                <a href="#" class="text-decoration-none text-white"><h5>Instructors</h5></a>              
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
                            <h4>Welcome to Admin Dashboard!</h4>
                            <i class="bi bi-person-circle fs-3"></i>
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
                </div>
            </div>
        </section>
    </body>
</html>