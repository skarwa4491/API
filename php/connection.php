<?php
$servername = "db";
$username = "root";
$password = "root";
$db_name = "student";

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);

// Check connection
if ($conn->connect_error) {
  echo "There is a problem";
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
