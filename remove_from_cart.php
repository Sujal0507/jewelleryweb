<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_from_cart"])) {
    $product_id = $_POST["product_id"];

    // Check if the product exists in the cart
    if (isset($_SESSION["cart"][$product_id])) {
        // Remove the product from the cart
        unset($_SESSION["cart"][$product_id]);

        // Redirect back to the cart page
        header("Location: cart.php");
        exit;
    }
}

// If the product is not found, handle it accordingly (e.g., display an error message)
?>
