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
                <div class="col-2 d-flex p-3 px-2 flex-column align-items-" id="admin-sidebar">                   
                    <h2 class="h4 text-center">Admin</h2>
                    <nav>
                        <div class="dash-nav d-flex gap-2 my-4 p-2 rounded">
                            <i class="bi bi-house"></i>
                            <h5>Dashboard</h5>
                        </div>
                        <div class="logout-nav d-flex justify-content-center gap-2 my-4 p-2 rounded position-absolute bottom-0 start-0">
                            <i class="bi bi-box-arrow-right"></i>
                            <h5>Log out</h5>
                        </div>
                    </nav>
                </div>

                <!-- Main Content -->
                <div class="col-10 offset-sm-2" id="admin-main-content">
                    <nav class="bg-success-subtle">
                        <div class="d-flex justify-content-between align-items-center p-3 px-3 ">
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