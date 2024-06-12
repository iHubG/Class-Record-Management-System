function activateLink() {
  // Get current URL path
  var path = window.location.pathname;
  
  // Remove 'active' class from all links
  var links = document.getElementsByClassName('dash-nav');
  for (var i = 0; i < links.length; i++) {
    links[i].classList.remove('active');
  }
  
  // Add 'active' class to the link that matches the current URL path
  if (path.includes('admin-dashboard')) {
    document.getElementById('dashboard-link').classList.add('active');
  } else if (path.includes('admin-instructor-dash')) {
    document.getElementById('instructor-link').classList.add('active');
  } else if (path.includes('admin-student')) {
    document.getElementById('student-link').classList.add('active');
  } else if (path.includes('admin-subject')) {
    document.getElementById('subject-link').classList.add('active');
  } else if (path.includes('admin-activity-logs')) {
    document.getElementById('activity-logs-link').classList.add('active');
  } else if (path.includes('admin-backup-restore')) {
    document.getElementById('backup-restore-link').classList.add('active');
  }
}

// Call activateLink on page load
window.onload = activateLink;


// Activate Tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

// Show Hide password
$(document).ready(function() {
  // Show/hide password functionality
  $('#togglePassword').click(function() {
      let passwordInput = $('#password');
      let icon = $(this);

      if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
          icon.removeClass('bi-eye').addClass('bi-eye-slash');
      } else {
          passwordInput.attr('type', 'password');
          icon.removeClass('bi-eye-slash').addClass('bi-eye');
      }
  });
});


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

 //






