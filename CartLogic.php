<?php
class Cart {
    public function addItem($product_id, $quantity = 1) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }

    public function getCartItems() {
        return $_SESSION['cart'] ?? [];
    }
}
?>