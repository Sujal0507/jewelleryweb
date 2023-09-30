<?php
require_once __DIR__ . '/vendor/autoload.php';?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


    $client = new MongoDB\Client("mongodb://localhost:27017");

    
    $db = $client->five_Jewellers;
    $collection = $db->admin;

   
    $user = $collection->findOne(["email" => $email]);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        header("Location: adminhome.php");
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
      <title>Admin Login </title>
      <link rel="stylesheet" href="css\signin.css">
      <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/favicon.png" type="image/png" sizes="32x32">
<link rel="icon" href="assets/favicon-192.png" type="image/png" sizes="192x192">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
           Admin 5ive Login 
         </div>
         <form action="alogin.php" method="POST">
            <div class="field">
               <input type="text" name="email"  required>
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password"  name="password" required>
               <label>Password</label>
            </div>
           
            <div class="field">
               <input type="submit" value="Login">
            </div>
         
         </form>
      </div>
      
   </body>
</html>