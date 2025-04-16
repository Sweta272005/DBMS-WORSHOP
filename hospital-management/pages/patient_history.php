<?php
include_once __DIR__ . '/../db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Patient History</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <h2 class="section-title">Patient History</h2>

  <form method="GET" action="">
    <input type="text" name="patient_id" placeholder="Enter Patient ID" required>
    <button type="submit">Search</button>
  </form>

  <?php
  if (isset($_GET['patient_id'])) {
      $patient_id = $_GET['patient_id'];
      $sql = "SELECT * FROM appointments WHERE patient_id = '$patient_id'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          echo "<table>";
          echo "<tr><th>Date</th><th>Time</th><th>Doctor</th><th>Status</th></tr>";
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                      <td>{$row['appointment_date']}</td>
                      <td>{$row['appointment_time']}</td>
                      <td>{$row['doctor_name']}</td>
                      <td>{$row['status']}</td>
                    </tr>";
          }
          echo "</table>";
      } else {
          echo "<p>No history found for Patient ID: $patient_id</p>";
      }
  }
  ?>
</body>
</html>
