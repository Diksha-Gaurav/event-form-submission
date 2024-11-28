<?php
session_start();
if (!isset($_GET['code']) || !isset($_SESSION['form_submitted']) || $_SESSION['form_submitted'] !== true) {
    header("Location: index.html"); // Redirect if accessed without submission
    exit;
}

$code = htmlspecialchars($_GET['code']); // Sanitize the code for output
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="success-message">
            <header>
                <h1>Registration Successful!</h1>
                <p>Thank you for registering for the event. Your unique registration code is:</p>
                <h2><?php echo $code; ?></h2>
                <p>Please keep this code for your reference and access pass.</p>
                <a href="index.html" class="submit-btn">Go Back</a>
            </header>
        </div>
    </div>
</body>
</html>
