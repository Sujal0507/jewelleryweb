<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");


$db = $client->five_Jewellers;
$collection = $db->contact_forms;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["First_Name"];
    $lastName = $_POST["Last_Name"];
    $email = $_POST["Email"];
    $message = $_POST["Message"];

  
    $contactDocument = [
        "first_name" => $firstName,
        "last_name" => $lastName,
        "email" => $email,
        "message" => $message
    ];

   
    $result = $collection->insertOne($contactDocument);

    if ($result->getInsertedCount() > 0) {
        echo "<script>alert('Thank you for your response,5ive Jewellers will contact you soon...');</script>";
    } else {
        echo "<script>alert('Message sending failed');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css\contact.css">
  <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/favicon.png" type="image/png" sizes="32x32">
<link rel="icon" href="assets/favicon-192.png" type="image/png" sizes="192x192">
  <title>Contact Us | 5ive</title>
</head>
  
<body>
<?php include('components\navbar.html');
  ?>
  <main>
  
    <section class="contact">
      <div class="container">
        <div class="left">
         <div class="form-wrapper">
          <div class="contact-heading">
            <h1>Connect to 5ive <span>.</span> </h1>
            <p class="text">via this : <a href="mailto:5ivejewellers@gmail.com">5ivejewellers@gmail.com</a></p>
          </div>

          <form action="" method="post" class="contact-form">
            <div class="input-wrap">
              <input class="contact-input" autocomplete="off" name="First Name" type="text" required placeholder="First Name">
  
              <i class="icon fa-solid fa-user"></i>
            </div>

            <div class="input-wrap">
              <input class="contact-input" autocomplete="off" name="Last Name" type="text" placeholder="Last Name" required>
              
              <i class="icon fa-solid fa-user"></i>
            </div>

            <div class="input-wrap w-100">
              <input class="contact-input" autocomplete="off" name="Email" type="email" placeholder="Email" required>
              <!-- <label for="">Email Id</label> -->
              <i class="icon fa-solid fa-envelope"></i>
            </div>

            <div class="input-wrap textarea w-100">
              <textarea name="Message" placeholder="Message in detail" id="" autocomplete="off" class="contact-input" required></textarea>
              
              <i class="icon fa-solid fa-message"></i>
            </div>

            <div class="contact-buttons">
              <input type="submit" value="Send Message" class="btn">
            </div>
            

          </form>
         </div> 
        </div>
        <div class="right">
          <div class="image-wrapper">
            <img src="/assets/aboutus.jpg" class="img">
          <div class="wave-wrap">
            <svg class="wave" viewBox="0 0 783 1536" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path id="wave" d="M236.705 1356.18C200.542 1483.72 64.5004 1528.54 1 1535V1H770.538C793.858 63.1213 797.23 196.197 624.165 231.531C407.833 275.698 274.374 331.715 450.884 568.709C627.393 805.704 510.079 815.399 347.561 939.282C185.043 1063.17 281.908 1196.74 236.705 1356.18Z"/>
              </svg>
          </div>
          <svg class="dashed-wave"  viewBox="0 0 345 877" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path id="dashed-wave" d="M0.5 876C25.6667 836.167 73.2 739.8 62 673C48 589.5 35.5 499.5 125.5 462C215.5 424.5 150 365 87 333.5C24 302 44 237.5 125.5 213.5C207 189.5 307 138.5 246 87C185 35.5 297 1 344.5 1" />
            </svg>
        </div>
      </div>
    </section>
  </main>
  
  <script src="js\contact.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
  
</body>
</html>

