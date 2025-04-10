<?php
include('../includes/db.php');
$result = mysqli_query($conn, "SELECT * FROM appointments");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Appointments</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #888;
            padding: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>All Appointments</h2>

<table>
    <tr>
        <th>Appointment ID</th>
        <th>Patient Name</th>
        <th>Patient ID</th>
        <th>Doctor Name</th>
        <th>Appointment Date</th>
        <th>Appointment Time</th>
        <th>Status</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['appointment_id']; ?></td>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['patient_id']; ?></td>
            <td><?php echo $row['doctor_name']; ?></td>
            <td><?php echo $row['appointment_date']; ?></td>
            <td><?php echo $row['appointment_time']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
