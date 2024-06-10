<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>
    <body id="login-body">
        <!-- Login -->
        <section id="login">
            <div class="container">
                <a class="ms-2 ms-lg-5 fs-1 mt-5"></a>
                <div class="row justify-content-center my-2 mt-lg-0 mt-xxl-5 my-lg-0 my-xxl-5">
                    <div class="col-10 shadow" id="login-box">
                        <div class="row flex-column flex-md-row flex-lg-row" id="login-box2">
                            <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center" id="login-left">
                                <img id="isu-icon" src="./public/img/isu-icon.png" alt="isu icon">
                            </div>
                            <div class="col-12 col-lg-6 text-center" id="login-right">
                                <h2 id="login-as">Login As</h2>
                                <div class="d-flex flex-column my-5 my-lg-0 mt-lg-5 gap-xxl-5 gap-lg-4 gap-4 align-items-center">
                                    <a href="/crms-project/admin-login" class="login-button">Admin</a>
                                    <a href="/crms-project/instructor-login" class="login-button">Instructor</a>
                                    <a href="/crms-project/student-login" class="login-button">Student</a>
                                </div>
                                <!--<img id="question-mark" src="./public/img/question-mark.png" alt="question mark">-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            // Hide content until everything is loaded
            document.documentElement.style.visibility = "hidden";

            function showContent() {
                document.documentElement.style.visibility = "visible";
            }

            // Only apply delay if the page is initially loading
            if (document.readyState === "loading") {
                // Introduce a delay of 0.5 seconds before showing content
                setTimeout(showContent, 500); // Delay of 0.5 seconds (500 milliseconds)
            } else {
                // If the page is already loaded, immediately show the content
                showContent();
            }
        </script>
    </body>
</html>