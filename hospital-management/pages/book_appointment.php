<?php
include('../includes/db.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Patient details
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $date_registered = date("Y-m-d");

    // Insert into patients table
    $insert_patient = "INSERT INTO patients (first_name, last_name, date_of_birth, gender, contact_number, address, date_registered)
                       VALUES ('$first_name', '$last_name', '$dob', '$gender', '$contact_number', '$address', '$date_registered')";
    
    if (mysqli_query($conn, $insert_patient)) {
        $patient_id = mysqli_insert_id($conn); // Get the new patient_id

        // Appointment details
        $doctor_name = $_POST['doctor_name'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $status = "Pending";

        $patient_name = $first_name . ' ' . $last_name;

        // Insert into appointments table
        $insert_appointment = "INSERT INTO appointments (patient_name, patient_id, doctor_name, appointment_date, appointment_time, status)
                               VALUES ('$patient_name', '$patient_id', '$doctor_name', '$appointment_date', '$appointment_time', '$status')";
        
        if (mysqli_query($conn, $insert_appointment)) {
            echo "<script>alert('✅ Appointment booked and patient added successfully!');</script>";
        } else {
            echo "<p style='color:red;'>❌ Appointment failed: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ Patient insertion failed: " . mysqli_error($conn) . "</p>";
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
            background-color: #f4f9ff;
        }
        .form-container {
            max-width: 650px;
            margin: auto;
            padding: 25px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background: #fff;
        }
        input, select, button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            border-radius: 5px;
            border: 1px solid #999;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        button {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Book an Appointment</h2>
    <form method="POST" action="">
        <!-- Patient Details -->
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" required>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="">-- Select Gender --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" required>

        <label for="address">Address:</label>
        <input type="text" name="address" required>

        <!-- Appointment Details -->
        <label for="doctor_name">Doctor:</label>
        <input list="doctors" name="doctor_name" required>
        <datalist id="doctors">
            <?php while ($row = mysqli_fetch_assoc($doctor_result)) {
                $docFull = $row['first_name'] . ' ' . $row['last_name'];
                $specialty = $row['specialty'];
                echo "<option value=\"$docFull ($specialty)\">";
            } ?>
        </datalist>

        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" required>

        <label for="appointment_time">Appointment Time:</label>
        <input type="time" name="appointment_time" required>

        <button type="submit">Book Appointment</button>
    </form>
</div>
</body>
</html>
