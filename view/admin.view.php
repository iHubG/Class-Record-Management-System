<?php

session_start();

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

// Clear errors and form data from session
unset($_SESSION['errors']);
unset($_SESSION['form_data']);

// Check if remember credentials cookie exists and decrypt it
$rememberedCredentials = isset($_COOKIE['remember_credentials']) ? json_decode($_COOKIE['remember_credentials'], true) : null;
$rememberedUsername = $rememberedCredentials['username'] ?? '';
$rememberedPassword = $rememberedCredentials['password'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body id="login-body">
    <!-- Login -->
    <section id="login">
        <div class="container">
            <a href="/crms-project/" class="text-black"><i class="bi bi-arrow-left-circle fs-1 ms-2 ms-lg-5 mt-5 cursor-pointer back" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Go back home"  data-bs-custom-class="custom-tooltip"></i></a>
        </div>
        <div class="container">
            <div class="row justify-content-center my-2 my-lg-0 my-xxl-5">
                <div class="col-10 shadow" id="login-box">
                    <div class="row flex-column flex-md-row flex-lg-row" id="login-box2">
                        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center" id="login-left">
                            <img id="isu-icon" src="./public/img/isu-icon.png" alt="isu icon">
                        </div>
                        <div class="col-12 col-lg-6" id="login-right">
                            <h2 id="login-as" class="text-center">Admin</h2>
                            <div class="d-flex flex-column my-5 gap-lg-5 gap-4 px-5">
                                <form action="/crms-project/admin-login-process" method="post">
                                    <!-- Username -->
                                    <div class="mb-3">
                                        <label for="username" class="form-label fw-bold">Username:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <input type="text" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?php echo (empty($_POST) && !isset($errors['username'])) ? htmlspecialchars($rememberedUsername) : (isset($formData['username']) ? htmlspecialchars($formData['username']) : ''); ?>" placeholder="Username" autocomplete="off" required>
                                        </div>
                                        <?php if (!empty($errors['username'])): ?>
                                            <div class="text-danger"><?php echo $errors['username']; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3 mb-lg-0 mb-xxl-3">
                                        <label for="password" class="form-label fw-bold">Password:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-key"></i>
                                            </span>
                                            <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?php echo htmlspecialchars($rememberedPassword); ?>" placeholder="Password" autocomplete="off" required>
                                        </div>
                                        <?php if (!empty($errors['password'])): ?>
                                            <div class="text-danger"><?php echo $errors['password']; ?></div>
                                        <?php elseif(isset($_POST['password']) && strlen($_POST['password']) < 8): ?>
                                            <div class="invalid-feedback">
                                                Password must be at least 8 characters long.
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="" id="rememberMe" name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            Remember Me
                                        </label>
                                    </div>

                                    <!-- Error message for login failure -->
                                    <?php if(isset($errors['login'])): ?>
                                        <div class="my-2 mt-xxl-3 text-center">
                                            <div class="text-danger">
                                                <?php echo $errors['login']; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="text-center">
                                        <input type="submit" name="submit" value="Login" class="btn btn-primary my-2 my-xxl-5 px-5">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
