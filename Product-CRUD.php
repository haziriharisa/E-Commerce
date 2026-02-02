<?php
include_once 'Database.php';
include_once 'Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    if ($product->create($_POST['title'], $_POST['price'], $_POST['category'], $_POST['image_url'])) {
        $message = "Product added successfully!";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    if ($product->delete($_GET['id'])) {
        header("Location: Product_admin.php?msg=deleted");
        exit();
    }
}

$all_products = $product->readAll();
?>