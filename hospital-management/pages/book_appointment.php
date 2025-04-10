<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $query = "INSERT INTO appointments (patient_name, doctor_id, appointment_date, appointment_time) 
              VALUES ('$patient_name', '$doctor_id', '$appointment_date', '$appointment_time')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Appointment booked successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 400px; margin: auto; background: #f4f4f4; padding: 20px; border-radius: 10px; }
        input, select, button { width: 100%; padding: 10px; margin: 10px 0; }
        button { background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
    <script>
        window.onload = function() {
            fetch('../pages/doctors.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById("doctorSelect").innerHTML = '<option value="">-- Select Doctor --</option>' + data;
                })
                .catch(error => console.error('Error loading doctors:', error));
        };
    </script>
</head>
<body>

<h2>Book an Appointment</h2>
<form method="POST">
    <label for="patient_name">Patient Name:</label>
    <input type="text" name="patient_name" required>

    <label for="doctor_id">Select Doctor:</label>
    <select name="doctor_id" id="doctorSelect" required>
        <option>Loading...</option>
    </select>

    <label for="appointment_date">Date:</label>
    <input type="date" name="appointment_date" required>

    <label for="appointment_time">Time:</label>
    <input type="time" name="appointment_time" required>

    <button type="submit">Book Appointment</button>
</form>

</body>
</html>


