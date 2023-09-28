<?php
session_start();

// Replace these with your actual username and password
$valid_username = 'username';
$hashed_password = password_hash('password', PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    if ($entered_username === $valid_username && password_verify($enteredpassword, $hashed_password)) {
        $_SESSION['authenticated'] = true;
        header('Location: edit_hours.php'); // Redirect to the opening hours editing page
        exit;
    } else {
        // Authentication failed
        echo "Authentication failed. Please try again.";
    }
}
?>
