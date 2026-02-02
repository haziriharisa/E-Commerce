<?php
    include_once 'Database.php';
    include_once 'Product.php';
    include_once 'PageContent.php';

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    $page = new PageContent($db);
    $content = $page->getPageData('home');

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    $stmt = $product->readAll($sort);
    $num = $stmt->rowCount();

    function e($key, $content, $default = "") {
    echo htmlspecialchars($content[$key] ?? $default);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
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
    <div class="hero">
        <div class="heroleft">
            <h1><?php e('home_title', $content, 'Solora'); ?></h1>
            <p> <?php e('home_desc', $content, 'About Our Company'); ?> </p>
            <div class="buttons">
                <a href="shop.html" class="btn">Shop Now</a>
                <a href="aboutus.html" class="btnoutlined">Read More</a>
            </div>
        </div>
        <div class="heroright">
            <img src="images/heroright22.png">
        </div>
    </div>

    <div class="banners">
        <div class="banner-left">
            <div class="bannerl-text">
                <h2>AirPods</h2>
            </div>
        </div>
          <div class="banner-middle">
            <div class="bannerm-text">
                <h2>IPhones</h2>
            </div>
        </div>
        <div class="banner-right">
            <div class="bannerr-text">
                <h2>Laptops</h2>
            </div> 
        </div>
    </div>

    <h2 id="latest"><?php e('latest_title', $content, 'Our Products'); ?></h2>
    <h2 id="latest-desc"><?php e('latest_desc', $content, 'Trenfing'); ?></h2>
    <div class="product-grid"> 
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="product-card">
                <h3 class="product-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                <img class="product-image" src="<?php echo $row['image_url']; ?>" alt="product">
                <p class="product-price">$<?php echo number_format($row['price'], 2); ?></p>
                <p class="product-category"><?php echo htmlspecialchars($row['category']); ?></p>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="subscribe">
        <h1 style="margin-bottom: 20px; color: white; font-size: 34px;"><?php e('news_title', $content, '15% Off'); ?></h1>
        <h3 style="color: white; font-size: 22px;"><?php e('news_desc', $content, 'Subscribe for the latest news.'); ?></h3>
        <form class="sub-form">
            <input type="email" placeholder="Enter your email address" class="email-section">
            <button type="submit" class="sub-btn">Subscribe</button>
        </form>
    </div>


    <div class="sale-section">
        <div class="sale-title">
            <h1><?php e('music_title', $content, 'New Headphones'); ?></h1>
            <p><?php e('music_desc', $content, 'Listen to your music with quality headphones'); ?></p>
            <button>Shop Now</button>
        </div>
        <div class="sale-image">
            <img src="images/a566d6b62e1ba31a0bc274f1fa1fd712.jpg">
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
                        <li><a href="">iPhones</a></li>
                        <li><a href="">iPads</a></li>
                        <li><a href="">Airpods</a></li>
                        <li><a href="">Macbooks</a></li>
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