<?php
session_start();

include_once("db_connection1.php");

$products = $collection->find();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    $product = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($product_id)]);

    if (!empty($product)) {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        $_SESSION["cart"][$product_id] = [
            "title" => $product["title"],
            "price" => $product["price"],
            "description" => $product["description"],
            "image" => $product["image"],
            "quantity" => isset($_SESSION["cart"][$product_id]["quantity"]) ? $_SESSION["cart"][$product_id]["quantity"] + 1 : 1,
        ];

        $message = "Product added successfully to the cart!";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="css/gold.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
<link rel="icon" href="assets/favicon.png" type="image/png" sizes="32x32">
<link rel="icon" href="assets/favicon-192.png" type="image/png" sizes="192x192">
</head>
<body>
    <?php include('components/navbar.html'); ?>
    <div class="poster">
        <img src="assets/diamond-new.jpg" alt="" srcset="">
    </div>
    
    
    <div class="product-container">
        <?php foreach ($products as $product) : ?>
            <div class="product">
                <form method="POST" onsubmit="displayMessage('<?php echo $message; ?>')">
                    <input type="hidden" name="product_id" value="<?= $product["_id"] ?>">
                    <img src="<?= $product["image"] ?>" alt="<?= $product["title"] ?>" width="100">
                    <h3><?= $product["title"] ?></h3>
                    <p> <?= $product['description']; ?></p>
                    <h3>Price: ₹ <?= $product["price"] ?></h3>
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
        <?php include('components/footer.html'); ?>
    </div>

    <script>
        function displayMessage(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</body>
</html>
