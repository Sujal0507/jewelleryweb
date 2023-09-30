<?php
session_start();

if (isset($_POST['key']) && isset($_POST['newQuantity'])) {
    $key = $_POST['key'];
    $newQuantity = (int)$_POST['newQuantity'];

    if ($newQuantity > 0) {
        // Update the quantity in the session cart
        $_SESSION['cart'][$key]['quantity'] = $newQuantity;
        echo 'Quantity updated successfully';
    } else {
        echo 'Quantity must be greater than zero';
    }
} else {
    echo 'Invalid request';
}
?>
