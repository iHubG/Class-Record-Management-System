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


// Search for Instructor
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("searchInput").addEventListener("input", function() {
      searchInstructors();
  });

  // Function to search instructors
  function searchInstructors() {
      const searchTerm = document.getElementById("searchInput").value.trim().toLowerCase();
      const instructorCards = document.querySelectorAll(".instructor-card");
      let found = false; // Variable to track if any results are found

      instructorCards.forEach(function(card) {
          const instructorName = card.querySelector("h5").textContent.trim().toLowerCase();
          if (searchTerm === "") {
              card.style.display = "block"; // Show all cards if search term is empty
              found = true; // Update found to true because there are results
          } else if (instructorName.includes(searchTerm)) {
              card.style.display = "block";
              found = true;
          } else {
              card.style.display = "none";
          }
      });

      // Display message when no results are found
      const noResultsMessage = document.getElementById("noResultsMessage");
      const searchTermSpan = document.getElementById("searchTerm");
      searchTermSpan.textContent = searchTerm;
      if (searchTerm === "") {
          noResultsMessage.style.display = "none"; // Hide message when search term is empty
      } else if (!found) {
          noResultsMessage.style.display = "block";
      } else {
          noResultsMessage.style.display = "none";
      }
  }
});





