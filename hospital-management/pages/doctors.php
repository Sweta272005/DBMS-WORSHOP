<?php
include('../db.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $specialty = $_POST['specialty'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $availability = $_POST['availability'];

    $insert_query = "INSERT INTO doctors (first_name, last_name, specialty, contact_number, email, availability)
                     VALUES ('$first_name', '$last_name', '$specialty', '$contact_number', '$email', '$availability')";
    mysqli_query($conn, $insert_query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Add Doctor</h1>
    <form method="POST" action="">
        <label>First Name: <input type="text" name="first_name" required></label><br>
        <label>Last Name: <input type="text" name="last_name" required></label><br>
        <label>Specialty: <input type="text" name="specialty" required></label><br>
        <label>Contact Number: <input type="text" name="contact_number" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Availability: <input type="text" name="availability" required></label><br><br>
        <input type="submit" value="Add Doctor">
    </form>

    <h2>Doctors List</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Specialty</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Availability</th>
            <th>Date Joined</th>
        </tr>

        <?php
        $query = "SELECT * FROM doctors ORDER BY doctor_id DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($doc = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $doc['doctor_id'] . "</td>
                        <td>" . $doc['first_name'] . "</td>
                        <td>" . $doc['last_name'] . "</td>
                        <td>" . $doc['specialty'] . "</td>
                        <td>" . $doc['contact_number'] . "</td>
                        <td>" . $doc['email'] . "</td>
                        <td>" . $doc['availability'] . "</td>
                        <td>" . $doc['date_joined'] . "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No doctors found.</td></tr>";
        }
        ?>
    </table>

    <br><a href="../index.php">← Back to Home</a>
</body>
</html>


