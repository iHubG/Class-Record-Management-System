<?php 

    // Define your routes
    $routes = [
        '/crms-project/' => 'index',
        '/crms-project/view' => 'login',
        '/crms-project/admin-login' => 'admin-login',
        '/crms-project/admin-logout' => 'admin-logout',
        '/crms-project/instructor-login' => 'instructor-login',
        '/crms-project/student-login' => 'student-login',
        '/crms-project/admin-login-process' => 'admin-process',
        '/crms-project/admin-dashboard' => 'admin-dashboard',
        '/crms-project/admin-instructor-dash' => 'admin-instructor',
        '/crms-project/admin-instructor-class' => 'admin-ins-class',
        '/crms-project/instructor-login-process' => 'instructor-process',
        '/crms-project/student-login-process' => 'student-process',
        '/crms-project/grading-sheets' => 'grades-sheet',
    ];

    // Get the current URL
    $url = $_SERVER['REQUEST_URI'];

    // Remove query string from URL
    $url = strtok($url, '?');

    // Check if the requested route exists
    if (array_key_exists($url, $routes)) {
        // If the route exists, call the associated function or include the corresponding file
        $route = $routes[$url];
        switch ($route) {
            case 'index':
                require ('./view/login.view.php'); 
                break;
            case 'login':
                require ('./view/login.view.php'); 
                break;
            case 'admin-login':
                require ('./view/admin.view.php'); 
                break;
            case 'admin-logout':
                require ('./controller/admin-logout.php'); 
                break;
            case 'admin-process':
                require ('./controller/admin-login-process.php'); 
                break;
            case 'admin-dashboard':
                require ('./view/admin-dash.view.php'); 
                break;
            case 'admin-instructor':
                require ('./view/admin-instructor.view.php'); 
                break;
            case 'admin-ins-class':
                require ('./view/admin-instructor-class.view.php'); 
                break;
            case 'instructor-login':
                require ('./view/instructor.view.php'); 
                break;
            case 'instructor-process':
                require ('./view/instructor-dash.view.php'); 
                break;
            case 'student-login':
                require ('./view/student.view.php'); 
                break;
            case 'student-process':
                require ('./view/student-dash.view.php'); 
                break;
            case 'grades-sheet':
                require ('./view/grading-sheets.view.php'); 
                break;
            default:
                // Handle 404 error
                echo "<h1 class='text-center text-muted my-5'>404 Page Not Found</h1>";
                break;
        }
    } else {
        // Handle 404 error
        echo "<h1 class='text-center text-muted my-5'>404 Page Not Found</h1>";

    }
