<?php
include('../includes/db.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $patient_id = $_POST['patient_id'];
    $doctor_name = $_POST['doctor_name'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = "Pending";

    $datetime = $appointment_date . ' ' . $appointment_time;

    $sql = "INSERT INTO appointments (patient_name, patient_id, doctor_name, appointment_date, appointment_time, status)
            VALUES ('$patient_name', '$patient_id', '$doctor_name', '$appointment_date', '$appointment_time', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Appointment booked successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch doctor list for suggestions
$doctor_query = "SELECT first_name, last_name, specialty FROM doctors";
$doctor_result = mysqli_query($conn, $doctor_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 25px;
            border: 2px solid #ccc;
            border-radius: 10px;
        }
        input, select, button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            border: 1px solid #999;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Book an Appointment</h2>
        <form method="POST" action="">
            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" autocomplete="off" required>

            <label for="patient_id">Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" required>

            <label for="doctor_name">Doctor:</label>
            <input list="doctors" id="doctor_name" name="doctor_name" required>
            <datalist id="doctors">
                <?php while ($row = mysqli_fetch_assoc($doctor_result)) {
                    $docFull = $row['first_name'] . ' ' . $row['last_name'];
                    $specialty = $row['specialty'];
                    echo "<option value=\"$docFull ($specialty)\">";
                } ?>
            </datalist>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <label for="appointment_time">Time:</label>
            <input type="time" id="appointment_time" name="appointment_time" required><br><br>

            <button type="submit">Book Appointment</button>
        </form>
    </div>
</body>
</html>
