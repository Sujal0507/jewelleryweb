<?php
session_start();


if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}


$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
  <?php include 'css\swiper.css'; 
?>
<?php include 'css\features.css'; 
?>
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&display=swap" rel="stylesheet">
<link rel="icon" href="assets/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/favicon.png" type="image/png" sizes="32x32">
<link rel="icon" href="assets/favicon-192.png" type="image/png" sizes="192x192">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | 5ive </title>
</head>
<body>

 

  <?php include('components\navbar.html');
  ?>

<div class="swiper">
  
  <div class="swiper-wrapper">
    
    <div class="swiper-slide"><img src="assets/slider1.jpg" alt="" srcset="" width="100px"></div>
    <div class="swiper-slide"><img src="assets/slider2.jpg" alt="" srcset=""></div>
    <div class="swiper-slide"><img src="assets/slider3.jpg" alt="" srcset=""></div>
    
  </div>
  
  <div class="swiper-pagination"></div>


  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="js\swiper.js"></script>
  
</div>
<center><h1 style="color: #9A0162;">Welcome to 5ive, <?php echo $_SESSION['username']; ?></h1></center>

<?php include('components\banner.html');
  ?>
 
<center>
  <h1 class="cardh2"> Our Features</h1></center>
  <a href="https://www.bis.gov.in/">
   <div class="card1" style="width: 5rem;margin-top: 120px;">
    <img class="card1-img-top" src="assets/100-Huid.svg"  alt="Card image cap">
      <h5 class="card1-title"><center> BIS Certificate</center></h5>
    </div></a>
  </div>

<a href="#">
  <div class="card1" style="width: 1rem;">
    <img class="card1-img-top" src="assets/assured-lifetime-maintenances2.svg"  alt="Card image cap">
      <h5 class="card1-title">Lifetime Maintanance</h5>
    </div>
  </div></a>

<a href="#">
  <div class="card1" style="width: 1rem;">
    <img class="card1-img-top" src="assets/guaranteed-buyback2.svg"  alt="Card image cap">
      <h5 class="card1-title">Easy Buyback</h5>
    </div>
  </div></a>

  <a href="#">
  <div class="card1" style="width: 1rem;">
    <img class="card1-img-top" src="assets/14-days-return-policy2.svg"  alt="Card image cap">
      <h5 class="card1-title">Easy Exchange</h5>
    </div>
  </div></a>
  
  


  
  <?php include('components\footer.html');
  ?>
  <script>
          
            alert("Welcome, <?php echo $username; ?> to 5ive Jewellery.");
        </script>
</body>
</html>