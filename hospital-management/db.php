<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';  // If you have set a root password, put it here
$database = 'hospital_db';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


