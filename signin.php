<?php
require_once __DIR__ . '/vendor/autoload.php';
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $client = new MongoDB\Client("mongodb://localhost:27017");

    $db = $client->five_Jewellers;
    $collection = $db->users;

    $user = $collection->findOne(["email" => $email]);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        $_SESSION["username"] = $user["name"]; 
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Incorrect email or password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css\signin.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/favicon.png" type="image/png" sizes="32x32">
<link rel="icon" href="assets/favicon-192.png" type="image/png" sizes="192x192">
</head>
<body>
<div class="wrapper">
    <div class="title">
        5ive Login
    </div>
    <form action="signin.php" method="POST">
        <div class="field">
            <input type="text" name="email" required>
            <label>Email Address</label>
        </div>
        <div class="field">
            <input type="password" name="password" required>
            <label>Password</label>
        </div>
        <div class="field">
            <input type="submit" value="Login">
        </div>
        <div class="signup-link">
            Not a Customer? <a href="signup.php">Signup now</a>
        </div>
    </form>
</div>
</body>
</html>
