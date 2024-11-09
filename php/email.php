<?php
require_once './db_config.php'; // Ensure the path to db_config.php is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Server-side validation for email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Invalid email format. Please try again.');
                window.location.href='../email_form.html'; // Adjust path as needed
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
                    window.location.href='../index.html'; // Redirect to the home page or a success page
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.location.href='../index.html'; // Adjust path as needed
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
                window.location.href='../email_form.html'; // Adjust path as needed
              </script>";
    }

    $conn->close();
}
?>
