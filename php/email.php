<?php
require_once './db_config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Server-side validation for email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Invalid email format. Please try again.');
                window.location.href='../index.html';
              </script>";
        exit;
    }

    // SQL query to insert the email into the database
    $sql = "INSERT INTO email_submissions (email) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Email submitted successfully!');
                    window.location.href='../index.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.location.href='../index.html';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
                window.location.href='../index.html';
              </script>";
    }

    $conn->close();
}
?>
