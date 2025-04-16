<?php
include_once __DIR__ . '/../db.php';

if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $patient_name = $_POST['patient_name'];
    $treatment_description = $_POST['treatment_description'];
    $amount = $_POST['amount'];
    $billing_date = date("Y-m-d");
    $payment_status = $_POST['payment_status'];
    $appointment_id = $_POST['appointment_id'];

    $sql = "INSERT INTO billing (patient_id, patient_name, treatment_description, amount, billing_date, payment_status, appointment_id)
            VALUES ('$patient_id', '$patient_name', '$treatment_description', '$amount', '$billing_date', '$payment_status', '$appointment_id')";

    if (mysqli_query($conn, $sql)) {
        $message = "✅ Billing information successfully added.";
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Billing Form</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            background-color: #f4f4f4;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Billing Information</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label>Patient ID:</label>
            <input type="text" name="patient_id" required>

            <label>Patient Name:</label>
            <input type="text" name="patient_name" required>

            <label>Appointment ID:</label>
            <input type="text" name="appointment_id" required>

            <label>Treatment Description:</label>
            <textarea name="treatment_description" required></textarea>

            <label>Amount (₹):</label>
            <input type="number" name="amount" required>

            <label>Payment Status:</label>
            <select name="payment_status" required>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
                <option value="Pending">Pending</option>
            </select>

            <button type="submit" class="submit-btn">Submit Billing</button>
        </form>
    </div>
</body>
</html>

