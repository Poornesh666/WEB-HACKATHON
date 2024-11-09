<?php
require_once './db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Server-side validation for email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format. Please go back and try again.");
    }

    // Validate phone number (should be exactly 10 digits)
    if (!preg_match('/^\d{10}$/', $phone)) {
        die("Invalid phone number. Please enter a 10-digit phone number.");
    }

    // SQL query to insert contact form data into the database
    $sql = "INSERT INTO contact_us (name, phone, email, subject, message)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $name, $phone, $email, $subject, $message);
        if ($stmt->execute()) {
            echo "Message sent successfully!";
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
