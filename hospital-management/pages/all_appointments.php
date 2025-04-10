<?php
include '../db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Appointments</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>All Appointments</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Patient ID</th>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php
        $sql = "SELECT * FROM appointments";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['appointment_id']}</td>
                    <td>{$row['patient_id']}</td>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['appointment_date']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
