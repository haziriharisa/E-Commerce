<?php
session_start();
require_once 'Database.php';
require_once 'User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $role = $user->login($email, $password);

    if ($role) {
        if ($role === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        header("Location: login.php?error=1");
        exit;
    }

if (isset($_POST['login'])) {
    
    session_start();
    session_unset();
    session_destroy();
    
    session_start();
    
    
    if ($password_is_correct) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['cart'] = []; 
        
        header("Location: shop.php");
        exit();
    }
}
}