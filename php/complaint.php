<?php
require_once './db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $vehicleModel = $_POST['vehicleModel'];
    $vehicleYear = $_POST['vehicleYear'];
    $complaintType = $_POST['complaintType'];
    $complaintDetails = $_POST['complaintDetails'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format. Please go back and try again.");
    }

    if (!preg_match('/^\d{10}$/', $phone)) {
        die("Invalid phone number. Please enter a 10-digit phone number.");
    }

    $sql = "INSERT INTO complaints (name, phone, email, vehicle_model, vehicle_year, complaint_type, complaint_details)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssiss", $name, $phone, $email, $vehicleModel, $vehicleYear, $complaintType, $complaintDetails);
        if ($stmt->execute()) {
            echo "<script>alert('Complaint registered successfully!'); window.location.href = '../index.html';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
