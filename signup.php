<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->five_Jewellers;
    $collection = $db->users;

    $existingUser = $collection->findOne(["email" => $email]);

    if ($existingUser) {
        echo "<script>alert('Email already exists');</script>";
    } else {
        $userDocument = [
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword
        ];

        $result = $collection->insertOne($userDocument);

        if ($result->getInsertedCount() > 0) {
            // Send a welcome email
            sendWelcomeEmail($email);

            echo "<script>alert('User registered successfully');</script>";
        } else {
            echo "<script>alert('Registration failed');</script>";
        }
    }
}

function sendWelcomeEmail($userEmail) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = '5iveJewellers@gmail.com'; // Your Gmail email address
        $mail->Password = 'arkfpvyodfvmrhsl'; // The app password you generated (or your Gmail account password if you didn't use an app password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Port for Gmail's SMTP server

        //Recipients
        $mail->setFrom('5iveJewellers@gmail.com', '5ive Jewellers'); // Replace with your email and name
        $mail->addAddress($userEmail); // The recipient's email address

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to 5ive Jewellers';
        $mail->Body    =  '<h1><b><span style="color: maroon;">Thank you for signing up at 5ive Jewellers.</span></b></h1>

        <br>Happy Shopping at 5ive. Where Style Meets Elegance<br>
        <p>Follow us on ig: @sujj_al_05 and
        Also on X: @Sujalpatel788 </p>';

        $mail->send();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5ive Login</title> 
    <link rel="stylesheet" href="css\signup.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/favicon.png" type="image/png" sizes="32x32">
<link rel="icon" href="assets/favicon-192.png" type="image/png" sizes="192x192">
</head>
<body>
  <div class="wrapper">
    <h2>Signup for 5ive</h2>
    <form action="signup.php" method="POST">
      <div class="input-box">
        <input type="text" name="name" placeholder="Enter your name" required>
      </div>
      <div class="input-box">
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Create password" required>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="signin.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>
