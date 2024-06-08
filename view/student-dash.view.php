<?php 
session_start();

// Assuming the student's ID is stored in the session
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

   // Prepare the SQL query to retrieve subject details for the student
   $sql = "SELECT subjects.id, subjects.subject_name, subjects.subject_code, subjects.section
        FROM class
        INNER JOIN subjects ON class.subject_id = subjects.id
        WHERE class.student_id = :student_id";

    // Prepare and execute the statement
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all rows as an associative array
    $student_subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Redirect to the login page if the student is not logged in
    header("Location: /crms-project/student-login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Dashboard</title>
    </head>
    <body>
        <section id="instructor-dash">
            <nav class="bg-success-subtle">
                <div class="container d-flex justify-content-between align-items-center p-3 ">
                    <h4>Student Dashboard</h4>
                    <i class="bi bi-person-circle fs-2"></i>
                </div>  
            </nav>
            <div class="container">
                <div class="row mt-5">
                    <?php foreach ($student_subjects as $subject): ?>
                        <div class="col-6 col-lg-3">
                            <a href="/crms-project/grading-sheets?subject_id=<?php echo htmlspecialchars($subject['id']); ?>" class="cursor-pointer text-decoration-none">
                                <div class="card card-shadow">
                                    <div class="card" aria-hidden="true">
                                        <img src="./public/img/isu-blur.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="text-black"><?php echo htmlspecialchars($subject['subject_name']); ?></h5>
                                            <h5><?php echo htmlspecialchars($subject['subject_code']); ?></h5>
                                            <h6 class="text-secondary"><?php echo htmlspecialchars($subject['section']); ?></h6>
                                            <div class="d-flex justify-content-between">
                                                <a href="/student-dashboard/chat"><i class="bi bi-chat fs-4"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </a>                
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </body>
</html>