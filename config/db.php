<?php 

$servername = 'localhost';
$username = 'ian';
$password = 'Admin1234';
$dbname = 'phptest';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}