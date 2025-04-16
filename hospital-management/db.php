<?php
// Only connect if not already connected
if (!isset($conn)) {
    $host = "localhost";        // MySQL server host
    $username = "root";         // Your MySQL username
    $password = "";             // Your MySQL password (empty if none)
    $database = "hospital_db";  // Your database name

    // Create connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("❌ Connection failed: " . mysqli_connect_error());
    }

    // Optional success message (comment out in production)
    // echo "✅ Connected to the database successfully.";
}
?>






