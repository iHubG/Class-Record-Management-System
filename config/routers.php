<?php 

    // Define your routes
    $routes = [
        '/crms-project/' => 'index',
        '/crms-project/view' => 'login',
        '/crms-project/admin-login' => 'admin-login',
        '/crms-project/admin-logout' => 'admin-logout',
        '/crms-project/admin-login-process' => 'admin-process',
        '/crms-project/admin-dashboard' => 'admin-dashboard',
        '/crms-project/admin-instructor-dash' => 'admin-instructor',
        '/crms-project/admin-instructor-class' => 'admin-ins-class',
        '/crms-project/admin-profile-pict' => 'admin-profilepict',
        '/crms-project/admin-update-instructor' => 'admin-update-instructor',
        '/crms-project/admin-activity-logs' => 'admin-activity-logs',
        '/crms-project/admin-backup-restore' => 'admin-backup-restore',
        '/crms-project/admin-backup' => 'admin-backup-database',
        '/crms-project/admin-restore' => 'admin-restore-database',
        '/crms-project/instructor-login' => 'instructor-login',
        '/crms-project/instructor-logout' => 'instructor-logout',
        '/crms-project/instructor-login-process' => 'instructor-process',
        '/crms-project/instructor-dashboard' => 'instructor-dashboard',
        '/crms-project/instructor-registration' => 'instructor-registration',
        '/crms-project/instructor-delete' => 'instructor-delete',
        '/crms-project/instructor-profile-pict' => 'instructor-profilepict',
        '/crms-project/instructor-update-profile' => 'instructor-update',
        '/crms-project/instructor-add-subject' => 'instructor-add-subject',
        '/crms-project/get-instructor-info' => 'instructor-info',
        '/crms-project/student-login' => 'student-login',
        '/crms-project/student-login-process' => 'student-process',
        '/crms-project/student-dashboard' => 'student-dashboard',
        '/crms-project/student-registration' => 'student-registration',
        '/crms-project/grading-sheets' => 'grades-sheet',
        '/crms-project/chat' => 'chat',
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
            case 'admin-profilepict':
                require ('./controller/admin-profile-pict.php'); 
                break;
            case 'admin-update-instructor':
                require ('./controller/admin-update-instructor.php'); 
                break;
            case 'admin-activity-logs':
                require ('./view/admin-activity-logs.view.php'); 
                break;
            case 'admin-backup-restore':
                require ('./view/admin-backup-restore.view.php'); 
                break;
            case 'admin-backup-database':
                require ('./controller/admin-backup.php'); 
                break;
            case 'admin-restore-database':
                require ('./controller/admin-restore.php'); 
                break;
            case 'instructor-login':
                require ('./view/instructor.view.php'); 
                break;
            case 'instructor-logout':
                require ('./controller/instructor-logout.php'); 
                break;
            case 'instructor-process':
                require ('./controller/instructor-login-process.php'); 
                break;
            case 'instructor-dashboard':
                require ('./view/instructor-dash.view.php'); 
                break;
            case 'instructor-registration':
                require ('./controller/instructor-registration-process.php'); 
                break;
            case 'instructor-delete':
                require ('./controller/instructor-delete.php'); 
                break;
            case 'instructor-profilepict':
                require ('./controller/instructor-profile-pict.php'); 
                break;
            case 'instructor-update':
                require ('./controller/instructor-update-profile.php'); 
                break;
            case 'instructor-add-subject':
                require ('./controller/instructor-add-subject.php'); 
                break;
            case 'instructor-info':
                require ('./controller/get-instructor-info.php'); 
                break;
            case 'student-login':
                require ('./view/student.view.php'); 
                break;
            case 'student-process':
                require ('./controller/student-login-process.php'); 
                break;
            case 'student-dashboard':
                require ('./view/student-dash.view.php'); 
                break;
            case 'student-registration':
                require ('./controller/student-registration-process.php'); 
                break;
            case 'grades-sheet':
                require ('./view/grading-sheets.view.php'); 
                break;
            case 'chat':
                require ('./view/chat.view.php'); 
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
