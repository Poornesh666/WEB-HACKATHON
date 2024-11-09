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
        echo "<script>
                alert('Invalid email format. Please go back and try again.');
                window.history.back();
              </script>";
        exit;
    }

    // Validate phone number (should be exactly 10 digits)
    if (!preg_match('/^\d{10}$/', $phone)) {
        echo "<script>
                alert('Invalid phone number. Please enter a 10-digit phone number.');
                window.history.back();
              </script>";
        exit;
    }

    // SQL query to insert contact form data into the database
    $sql = "INSERT INTO contact_us (name, phone, email, subject, message)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $name, $phone, $email, $subject, $message);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Message sent successfully!');
                    window.location.href = '../index.html'; // Change this to your desired redirection page
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . addslashes($stmt->error) . "');
                    window.history.back();
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Error: " . addslashes($conn->error) . "');
                window.history.back();
              </script>";
    }

    $conn->close();
}
?>
