<?php
include_once 'Database.php';
include_once 'Product.php';
include_once 'SessionManager.php'; 
include_once 'CartLogic.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$session = new SessionManager();
$cart = new Cart();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if ($session->isLoggedIn()) {
        $p_id = $_POST['product_id'];
        $cart->addItem($p_id);
        header("Location: shop.php?status=success");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$stmt = $product->readAll($sort);
$num = $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <header id="header">
        <div style="display: flex; justify-content: center; gap: 10px; align-items: center; margin-right: 20px;">
            <button class="menu-toggle" id="menuBtn">
                <i class="fas fa-bars"></i>
            </button>
             <a href="index.html">
                <img class="logo" src="images/Screenshot_2025-11-14_100306-removebg-preview.png" alt="logo" onerror="this.src='https://via.placeholder.com/150x50?text=Logo'">
            </a>
        </div>
        <nav id="navbar">
            <ul class="nav_links">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="icons" id="headerIcons">
            <a href="cart.php" style="position: relative;">
                <i id="cart" class="fa-solid fa-cart-shopping"></i>
                <?php 
                    $count = array_sum($cart->getCartItems());
                    if ($count > 0): 
                ?>
                    <span style="position: absolute; top: -10px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 8px; font-size: 12px;">
                        <?php echo $count; ?>
                    </span>
                <?php endif; ?>
            </a>
            <a href="login.php"><i id="account" class="fa-solid fa-user"></i></a>
        </div>
    </header>

<div class="shop-page-container">

    <div class="shop-sidebar">
        <h3>Filter Products</h3>
        
        <div class="filter-group">
            <h4>Category</h4>
            <ul>
                <li><a href="#">IPhones</a></li>
                <li><a href="#">IPads</a></li>
                <li><a href="#">MacBooks</a></li>
                <li><a href="#">AirPods</a></li>
            </ul>
        </div>
        
        <div class="filter-group">
            <h4>Price Range</h4>
            <input type="range" min="0" max="1500" value="750" class="slider" id="price-range">
            <p>Max Price: $<span id="price-value">1500</span></p>
        </div>
        
    </div>

        <div class="product-listing">
            <div class="listing-header">
                <h2>All Products (<?php echo $num; ?> Items)</h2>
                <form method="GET">
                    <select name="sort" class="sort-dropdown" onchange="this.form.submit()">
                        <option value="default" <?php echo $sort == 'default' ? 'selected' : ''; ?>>Sort By: Featured</option>
                        <option value="price-asc" <?php echo $sort == 'price-asc' ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price-desc" <?php echo $sort == 'price-desc' ? 'selected' : ''; ?>>Price: High to Low</option>
                    </select>
                </form>
            </div>

            <div class="product-grid"> 
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="product-card">
                        <h3 class="product-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <img class="product-image" src="<?php echo $row['image_url']; ?>" alt="product">
                        <p class="product-price">$<?php echo number_format($row['price'], 2); ?></p>
                        <p class="product-category"><?php echo htmlspecialchars($row['category']); ?></p>
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="add_to_cart" class="add-to-cart">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="pagination">
                <a href="#">&laquo; Previous</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">Next &raquo;</a>
            </div>
        </div>
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