<?php

require_once 'Database.php';
require_once 'Contact.php';

$feedback = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $database = new Database();
    $db = $database->getConnection();
    $contact = new Contact($db);

    $fName   = $_POST['firstName'];
    $lName   = $_POST['lastName'];
    $email   = $_POST['email'];
    $mobile  = $_POST['mobile'];
    $msg     = $_POST['message'];

    if ($contact->saveMessage($fName, $lName, $email, $mobile, $msg)) {
        $feedback = "success";
    } else {
        $feedback = "error";
    }

    header("Location: contactus.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Solora</title>
</head>
<body>
    <header id="header">
        <div style="display: flex; justify-content: center; gap: 10px; align-items: center; margin-right: 20px;">
            <button class="menu-toggle" id="menuBtn">
                <i class="fas fa-bars"></i>
            </button>
             <a href="index.php">
                <img class="logo" src="images/Screenshot_2025-11-14_100306-removebg-preview.png" alt="logo" onerror="this.src='https://via.placeholder.com/150x50?text=Logo'">
            </a>
        </div>
        <nav id="navbar">
            <ul class="nav_links">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="icons" id="headerIcons">
            <a href="cart.php"><i id="cart" class="fa-solid fa-cart-shopping"></i></a>
            <a href="login.php"><i id="account" class="fa-solid fa-user"></i></a>
        </div>
    </header>
      <?php if ($feedback == "success"): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            <strong>Success!</strong> Your message has been recorded in our database.
        </div>
    <?php elseif ($feedback == "error"): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            <strong>Error!</strong> Something went wrong. Please try again.
        </div>
    <?php endif; ?>
   <div class="form-container">

    <form action="contactus.php" method="POST">
        <h1>Contact Us</h1>
        
        <input type="text" name="firstName" placeholder="First Name" required>
        <input type="text" name="lastName" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="mobile" placeholder="Number" required>
        
        <h4>Type Your Message Here...</h4>
        <textarea name="message" required></textarea>
        
        <input type="submit" method="POST" value="Send" id="button">
    </form> 
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4 style="padding-bottom: 5px;">company</h4>
                    <ul>
                        <li><a href="">about us</a></li>
                        <li><a href="">our services</a></li>
                        <li><a href="">privacy policy</a></li>
                        <li><a href="">affiliate program</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="padding-bottom: 5px;">get help</h4>
                    <ul>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">shipping</a></li>
                        <li><a href="">returns</a></li>
                        <li><a href="">order status</a></li>
                        <li><a href="">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="padding-bottom: 5px;">online shop</h4>
                    <ul>
                        <li><a href="">iphones</a></li>
                        <li><a href="">ipads</a></li>
                        <li><a href="">airpods</a></li>
                        <li><a href="">macbooks</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 style="padding-bottom: 5px;">follow us</h4>
                    <div class="social-links">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="nav.js"></script>
</body>
</html>