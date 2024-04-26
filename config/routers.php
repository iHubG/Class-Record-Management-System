<?php 

    // Define your routes
    $routes = [
        '/crms-project/' => 'index',
        '/crms-project/view/' => 'login',
        '/crms-project/admin-login' => 'admin-login',
        '/crms-project/instructor-login' => 'instructor-login',
        '/crms-project/student-login' => 'student-login',
        '/crms-project/admin-login-process' => 'admin-process',
        '/crms-project/instructor-login-process' => 'instructor-process',
        '/tutorial/register_validation' => 'register_validation',
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
                require ('./view/login.view.php'); // Include the file for the home page
                break;
            case 'login':
                require ('./view/login.view.php'); // Include the file for the home page
                break;
            case 'admin-login':
                require ('./view/admin.view.php'); // Include the file for the home page
                break;
            case 'admin-process':
                require ('./view/admin-dash.view.php'); // Include the file for the home page
                break;
            case 'instructor-login':
                require ('./view/instructor.view.php'); // Include the file for the home page
                break;
            case 'instructor-process':
                require ('./view/instructor-dash.view.php'); // Include the file for the home page
                break;
            case 'student-login':
                require ('./view/student.view.php'); // Include the file for the home page
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
