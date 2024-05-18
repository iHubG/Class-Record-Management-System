<?php
// Set a cookie
setcookie('test_cookie', 'Hello, Cookie!', time() + 3600, '/');

// Check if the cookie is set
if (isset($_COOKIE['test_cookie'])) {
    echo 'Cookie is set! Value: ' . $_COOKIE['test_cookie'];
} else {
    echo 'Cookie is not set.';
}
?>
