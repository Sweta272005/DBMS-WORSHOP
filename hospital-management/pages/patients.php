<?php
// Include the database connection
include('../db.php');

// Query to fetch patient data
$query = "SELECT patient_id, first_name, last_name, date_of_birth, gender, contact_number, address, date_registered FROM patients";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    echo "<h2>Patients List</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Registration Date</th>
            </tr>";
    
    // Loop through each row and display patient data
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate age from date of birth
        $dob = new DateTime($row['date_of_birth']);
        $today = new DateTime();
        $age = $today->diff($dob)->y;
        
        // Display patient information
        echo "<tr>
                <td>" . $row['patient_id'] . "</td>
                <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
                <td>" . $age . "</td>
                <td>" . $row['gender'] . "</td>
                <td>" . $row['contact_number'] . "</td>
                <td>" . $row['address'] . "</td>
                <td>" . $row['date_registered'] . "</td>
            </tr>";
    }
    
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>



