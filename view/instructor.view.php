<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Instructor Login</title>
    </head>
    <body id="login-body">
        <!-- Login -->
        <section id="login">
            <div class="container">
                <div class="row justify-content-center my-5">
                    <div class="col-10 shadow" id="login-box">
                        <div class="row flex-column flex-md-row flex-lg-row" id="login-box2">
                            <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center" id="login-left">
                                <img id="isu-icon" src="./public/img/isu-icon.png" alt="isu icon">
                            </div>
                            <div class="col-12 col-lg-6" id="login-right">
                                <h2 id="login-as" class="text-center">Instructor</h2>
                                <div class="d-flex flex-column my-5 gap-lg-5 gap-4 px-5">
                                <form action="/crms-project/instructor-login-process" method="post">
                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email address:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope-at"></i>
                                            </span>
                                            <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>" placeholder="yourname@example.com" autocomplete="off" required>
                                        </div>
                                        <?php if (!empty($errors['email'])): ?>
                                            <div class="text-danger"><?php echo $errors['email']; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3 mb-lg-0 mb-xxl-3">
                                        <label for="password" class="form-label fw-bold">Password:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-key"></i>
                                            </span>
                                            <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" autocomplete="off" required>
                                        </div>

                                        <?php if (!empty($errors['password'])): ?>
                                            <div class="text-danger"><?php echo $errors['password']; ?></div>
                                        <?php elseif(isset($_POST['password']) && strlen($_POST['password']) < 8): ?>
                                            <div class="invalid-feedback">
                                                Password must be at least 8 characters long.
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Error message for login failure -->
                                    <?php if(isset($errors['login'])): ?>
                                        <div class="mb-3">
                                            <div class="text-danger">
                                                <?php echo $errors['login']; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="text-center">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary my-5 px-5">Login</button>
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