<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["user"])) {
    // Destroy the session to log the user out
    session_destroy();
    
    // Display a logout success message using JavaScript
    echo "<script>alert('Logout successfully.');</script>";
}

// Redirect the user to the login page after a delay
echo "<script>setTimeout(function() { window.location.href = 'signin.php'; }, 1000);</script>";
?>
