<?php
require_once './db_config.php'; // Ensure the path is correct based on your project structure

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to fetch user data
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password matches
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];

            // Show success alert and redirect to the home page
            echo "<script>
                    alert('Login successful! Welcome, " . $user['name'] . "');
                    window.location.href='../index.html';
                  </script>";
        } else {
            // Invalid password
            echo "<script>
                    alert('Invalid password. Please try again.');
                    window.location.href='../login.html';
                  </script>";
        }
    } else {
        // No user found with the provided email
        echo "<script>
                alert('No user found with that email address.');
                window.location.href='../login.html';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>