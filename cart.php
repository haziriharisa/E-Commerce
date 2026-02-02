<?php
include_once 'Database.php';
include_once 'SessionManager.php';
include_once 'CartLogic.php';

$session = new SessionManager();
$cart = new Cart();
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_qty'])) {
        $p_id = $_POST['product_id'];
        $new_qty = $_POST['quantity'];
        if ($new_qty > 0) {
            $_SESSION['cart'][$p_id] = $new_qty;
        } else {
            unset($_SESSION['cart'][$p_id]);
        }
    }
    if (isset($_POST['remove_item'])) {
        unset($_SESSION['cart'][$_POST['product_id']]);
    }
    header("Location: cart.php");
    exit();
}

$cart_items = $cart->getCartItems();
$subtotal = 0;
$delivery_fee = 20.50; 
$tax_rate = 0.18;   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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

    <div class="cart">
        <h1 class="cart-title">Your Shopping Cart</h1>
        <div class="cart-container">
            <div class="cart-items">
                <?php if (!empty($cart_items)): ?>
                    <?php 
                    foreach ($cart_items as $id => $quantity): 
                        $query = "SELECT * FROM products WHERE id = :id";
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $product = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($product):
                            $item_total = $product['price'] * $quantity;
                            $subtotal += $item_total;
                    ?>
                        <div class="cart-item">
                            <img src="<?php echo $product['image_url']; ?>" alt="product" class="item-img">
                            <div class="item-details">
                                <p class="item-name"><?php echo htmlspecialchars($product['title']); ?></p>
                                <p class="item-desc"><?php echo htmlspecialchars($product['category']); ?></p>
                            </div>
                            
                            <form method="POST" class="quantity-controls" style="display:flex; align-items:center;">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button type="submit" name="update_qty" value="down" class="qty-btn" onclick="this.form.quantity.value--"><i class="fas fa-minus"></i></button>
                                <input type="number" name="quantity" value="<?php echo $quantity; ?>" readonly style="width:30px; text-align:center; border:none; background:transparent;">
                                <button type="submit" name="update_qty" value="up" class="qty-btn" onclick="this.form.quantity.value++"><i class="fas fa-plus"></i></button>
                            </form>

                            <p class="item-price">$<?php echo number_format($item_total, 2); ?></p>
                            
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button type="submit" name="remove_item" class="remove-btn">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    <?php endif; endforeach; ?>
                <?php else: ?>
                    <p>Your cart is empty. <a href="shop.php">Start shopping!</a></p>
                <?php endif; ?>
            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal (<?php echo array_sum($cart_items); ?> items)</span>
                    <span>$<?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Delivery Fee</span>
                    <span>$<?php echo number_format($delivery_fee, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Estimated Tax (18%)</span>
                    <span>$<?php echo number_format($subtotal * $tax_rate, 2); ?></span>
                </div>
                
                <div class="summary-total">
                    <span>Total</span>
                    <span>$<?php 
                        $grand_total = $subtotal + $delivery_fee + ($subtotal * $tax_rate);
                        echo number_format($grand_total, 2); 
                    ?></span>
                </div>

                <button class="checkout-btn">Proceed to Checkout <i class="fas fa-arrow-right"></i></button>
                <a href="shop.php" class="continue-shopping"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
            </div>
        </div>
    </div>
    <footer>
        <div class="container-footer">
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