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


// Acticate Tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

