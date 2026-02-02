<?php
require_once 'Database.php';
require_once 'SessionManager.php';
require_once 'Cart.php';

$session = new SessionManager();
$cart = new Cart();

if ($session->isLoggedIn() && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $cart->addItem($product_id);

    header("Location: shop.php?status=added");
    exit();
} else {
    header("Location: login.php");
}

?>