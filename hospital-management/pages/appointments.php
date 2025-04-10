<?php
include '../db.php';  // include database connection

$query = "SELECT * FROM appointments";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
</head>
<body>
    <h1>All Appointments</h1>
    <table border="1">
        <tr>
            <th>Appointment ID</th>
            <th>Patient ID</th>
            <th>Doctor Name</th>
            <th>Appointment Date</th>
            <th>Status</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['appointment_id']; ?></td>
                <td><?php echo $row['patient_id']; ?></td>
                <td><?php echo $row['doctor_name']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
