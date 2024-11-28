<?php
$servername = "localhost";
$username = "root"; // Default username
$password = ""; // Default password
$database = "event_details"; // Database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
