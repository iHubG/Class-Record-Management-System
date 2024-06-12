<?php 
  session_start();
  // Check if the user is logged in
  if (!isset($_SESSION['instructor_id'])) {
      header('Location: /crms-project/instructor-login');
      exit();
  }
  
  // Ensure a subject ID is provided
  if (!isset($_GET['subject_id']) || !is_numeric($_GET['subject_id'])) {
      // Handle the case when no subject ID is provided
      echo "Please select a subject.";
      exit();
  }
  
  $subject_id = $_GET['subject_id'];
  $instructor_id = $_SESSION['instructor_id'];

  $_SESSION['subject_id'] = $subject_id;
  
  // Check if the selected subject belongs to the logged-in instructor
  $stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = :subject_id AND instructor_id = :instructor_id");
  $stmt->execute(['subject_id' => $subject_id, 'instructor_id' => $instructor_id]);
  $subject = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if (!$subject) {
      // Handle the case when the subject does not belong to the instructor
      echo "You are not authorized to access this subject.";
      exit();
  }
  
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Grading Sheets</title>
    </head>
    <body>
        <section id="grading-sheets">
            <a href="/crms-project/class-record?subject_id=<?php echo htmlspecialchars($subject['id']); ?>" class="text-black"><i class="bi bi-arrow-left-circle fs-1 ms-2 ms-lg-5 mt-5 cursor-pointer back" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Go back"  data-bs-custom-class="custom-tooltip"></i></a>
            <h2 class="text-center mt-3 mb-5"><?php echo htmlspecialchars($subject['subject_name'] . ' ' . $subject['section'] ); ?> Grade Sheet</h2>

            <div class="container-fluid">
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-8 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search Student" aria-label="Search name" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="searchButton"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                 <!-- Message to display when no results are found -->
                 <div id="noResultsMessage" class="mt-3 mb-3 text-muted text-center" style="display: none;">No results found for "<span id="searchTerm"></span>".</div>

                    <?php 
                        // Query to retrieve student details including final grade and remarks for the given subject ID
$stmt = $pdo->prepare("SELECT student.id, student.first_name, student.last_name, class.final_grade, class.remarks 
FROM student 
INNER JOIN class ON student.id = class.student_id 
WHERE class.subject_id = ?");
$stmt->execute([$subject_id]);

// Fetch student details from the database
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='table table-striped'>";
echo "<thead class='thead-dark'>";
echo "<tr>
<th>#</th>
<th>Last Name</th>
<th>First Name</th>
<th>Final Grade</th>
<th>Remarks</th>
</tr>";
echo "</thead>";
echo "<tbody class='searchResults'>";

$rowNumber = 1;

foreach ($students as $student) {
echo "<tr id='row_$rowNumber'>";
echo "<td>" . $rowNumber . "</td>";
echo "<form action='/crms-project/instructor-update-student' method='post'>";           
echo "<td><input type='text' class='form-control w-auto' name='lastName' value='" . (isset($student['last_name']) ? htmlspecialchars($student['last_name']) : '') . "' readonly autocomplete='off'></td>";
echo "<td><input type='text' class='form-control w-auto' name='firstName' value='" . (isset($student['first_name']) ? htmlspecialchars($student['first_name']) : '') . "' readonly autocomplete='off'></td>";
echo "<td><input type='text' class='form-control w-auto' name='finalGrade' value='" . (isset($student['final_grade']) ? htmlspecialchars($student['final_grade']) : '') . "' readonly autocomplete='off'></td>";
echo "<td><input type='text' class='form-control w-auto' name='Remarks' value='" . (isset($student['remarks']) ? htmlspecialchars($student['remarks']) : '') . "' readonly autocomplete='off'></td>";
echo "</tr>";
$rowNumber++;
}
echo "</tbody>";
echo "</table>";
                    ?>

                    <script>
                        // Delegate event handling for "Edit" buttons
                        document.addEventListener("click", function(event) {
                            var target = event.target;
                            if (target.classList.contains("edit-button")) {
                                var rowNumber = target.dataset.row; // Get the row number from data attribute
                                enableEditing(rowNumber);
                            }
                        });

                        // Function to enable editing for a specific row
                        function enableEditing(rowNumber) {
                            // Get the row element
                            var row = document.getElementById('row_' + rowNumber);
                            if (row) { // Check if the row element exists
                                // Find all input fields within the row using querySelectorAll
                                var inputs = row.querySelectorAll('input[type="text"]');
                                // Toggle the readonly attribute for each input field
                                inputs.forEach(function(input) {
                                    input.readOnly = !input.readOnly;
                                });
                            }
                        }

                        document.addEventListener("DOMContentLoaded", function () {
                            // Function to perform live search for students
                            function performSearch() {
                                var searchTerm = document.getElementById("searchInput").value.trim().toLowerCase();
                                var rows = document.querySelectorAll('.searchResults tr'); // Select all rows inside tbody with class 'searchResults'
                                var hasResults = false;

                                rows.forEach(function(row) {
                                    var lastName = row.querySelector('[name="lastName"]').value.trim().toLowerCase();
                                    var firstName = row.querySelector('[name="firstName"]').value.trim().toLowerCase();
                                    var rowText = lastName + " " + firstName;

                                    if (rowText.includes(searchTerm)) {
                                        row.style.display = "";
                                        hasResults = true;
                                    } else {
                                        row.style.display = "none";
                                    }
                                });

                                // Show or hide no results message
                                var noResultsMessage = document.getElementById("noResultsMessage");
                                if (searchTerm === "" || hasResults) {
                                    noResultsMessage.style.display = "none";
                                } else {
                                    noResultsMessage.innerHTML = "No results found for \"" + searchTerm + "\".";
                                    noResultsMessage.style.display = "block";
                                }
                            }

                            // Event listener for live search
                            document.getElementById("searchInput").addEventListener("input", function () {
                                performSearch();
                            });
                        });
                    </script>
            </div>
        </section>
    </body>
</html>