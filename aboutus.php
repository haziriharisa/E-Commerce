<?php
require_once 'Database.php';
require_once 'PageContent.php';

$database = new Database();
$db = $database->getConnection();

$page = new PageContent($db);
$content = $page->getPageData('aboutus');
$team = $page->getTeamMembers();

function e($key, $content, $default = "") {
    echo htmlspecialchars($content[$key] ?? $default);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/aboutus.css">
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
                <li><a href="shop.html">Shop</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contactus.html">Contact Us</a></li>
            </ul>
        </nav>

        <div class="icons" id="headerIcons">
            <a href="cart.php"><i id="cart" class="fa-solid fa-cart-shopping"></i></a>
            <a href="login.php"><i id="account" class="fa-solid fa-user"></i></a>
        </div>
    </header>
       <div class="hero-section">
        <h1><?php e('hero_title', $content, 'About Our Company'); ?></h1>
        </div>
       <div class="story-section">
            <h2>Our Story & Mission</h2>
            <p><?php e('story_text', $content, 'Default story text goes here...'); ?></p>
        </div>

        <div class="values">
            <h2>Our Core Pillars</h2>
            <div class="values-grid">
                <div class="pillar-card">
                    <span class="icon"><i class="fa-solid fa-medal"></i></span>
                    <h3><?php e('pillar_1_title', $content, 'Curated Excellence'); ?></h3>
                    <p><?php e('pillar_1_desc', $content, 'Quality assurance description.'); ?></p>
                </div>

                <div class="pillar-card">
                    <span class="icon"><i class="fa-solid fa-mobile"></i></span>
                    <h3><?php e('pillar_2_title', $content, 'Sustainable Tech'); ?></h3>
                    <p><?php e('pillar_2_desc', $content, 'Sustainability description.'); ?></p>
                </div>

                <div class="pillar-card">
                    <span class="icon"><i class="fa-solid fa-handshake"></i></span>
                    <h3><?php e('pillar_3_title', $content, 'Dedicated Support'); ?></h3>
                    <p><?php e('pillar_3_desc', $content, 'Support description.'); ?></p>
                </div>
            </div>         
        </div>
      <div class="team-section">
        <h2>Meet Our Team</h2>
            <div class="team-container">
                <?php if (!empty($team)): ?>
                    <?php foreach ($team as $member): ?>
                        <div class="team-member-card"> 
                            <div class="member-info">
                                <img src="<?php echo htmlspecialchars($member['image_path']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                                <h3><?php echo htmlspecialchars($member['name']); ?></h3>
                                <p class="role"><?php echo htmlspecialchars($member['role']); ?></p>
                                <p class="description"><?php echo htmlspecialchars($member['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Our team is growing! Check back soon.</p>
                <?php endif; ?>
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