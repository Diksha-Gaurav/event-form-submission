<?php
include 'db.php'; // Include your database connection file
session_start(); // Start session to track form submission

// Function to generate a unique 4-digit code
function generateUniqueCode($conn) {
    do {
        $code = random_int(1000, 9999); // Generate a random 4-digit code
        // Check if the code already exists in the database
        $result = $conn->query("SELECT * FROM clients WHERE code = '$code'");
    } while ($result->num_rows > 0); // Repeat until the code is unique
    return $code;
}

// Check if the form was already submitted in this session
if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
    // Redirect to the success page with the stored code
    header("Location: success.php?code=" . $_SESSION['unique_code']);
    exit;
}

// Retrieve and sanitize form inputs
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
$phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
$company = isset($_POST['company']) ? $conn->real_escape_string($_POST['company']) : '';
$address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';

// Generate a unique 4-digit code
$code = generateUniqueCode($conn);

// Insert client data into the database
$sql = "INSERT INTO clients (name, email, phone, company, address, code) 
        VALUES ('$name', '$email', '$phone', '$company', '$address', '$code')";

if ($conn->query($sql) === TRUE) {
    // Store form submission status and the unique code in session
    $_SESSION['form_submitted'] = true;
    $_SESSION['unique_code'] = $code;

    // Redirect to the success page
    header("Location: success.php?code=$code");
    exit;
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
