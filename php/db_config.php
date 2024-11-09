<?php
$host = "localhost";
$user = "root";
$password = "Poornesh@20069";
$dbname = "car_services_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>