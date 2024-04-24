<?php 

    // Define your routes
    $routes = [
        '/crms-project/' => 'index',
        '/crms-project/view/' => 'login',
        '/tutorial/register' => 'register',
        '/tutorial/table' => 'table',
        '/tutorial/router' => 'router',
        '/tutorial/login_process' => 'login_process',
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
            case 'register':
                require ''; // Include the file for the about page
                break;
            case 'table':
                require ''; // Include the file for the contact page
                break;
            case 'login_process':
                require ''; // Include the file for the contact page
                break;
            case 'register_validation':
                require ''; // Include the file for the contact page
                break;
            // Add more routes as needed
            default:
                // Handle 404 error
                echo "<h1 class='text-center text-muted my-5'>404 Page Not Found</h1>";
                break;
        }
    } else {
        // Handle 404 error
        echo "<h1 class='text-center text-muted my-5'>404 Page Not Found</h1>";

    }
