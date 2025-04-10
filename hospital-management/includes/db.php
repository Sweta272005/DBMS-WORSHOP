<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';  // If you have set a root password, put it here
$database = 'hospital_db';


$conn = mysqli_connect("localhost", "root", "", "hospital_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>



