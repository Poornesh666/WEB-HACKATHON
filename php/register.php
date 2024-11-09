<?php
require_once './db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Server-side validation for email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format. Please try again.'); window.location.href='../register.html';</script>";
        exit;
    }

    // Validate phone number (should be exactly 10 digits)
    if (!preg_match('/^\d{10}$/', $phone)) {
        echo "<script>alert('Invalid phone number. Please enter a 10-digit phone number.'); window.location.href='../register.html';</script>";
        exit;
    }

    // Server-side validation for password confirmation
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.location.href='../register.html';</script>";
        exit;
    }

    // Check if the email already exists in the database
    $checkSql = "SELECT email FROM users WHERE email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "<script>alert('The email address is already registered. Please use a different email.'); window.location.href='../register.html';</script>";
        exit;
    }

    $checkStmt->close();

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to insert user data into the database
    $sql = "INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $phone, $email, $hashedPassword);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='../index.html';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='../index.html';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='../index.html';</script>";
    }

    $conn->close();
}
?>
