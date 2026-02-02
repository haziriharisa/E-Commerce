<?php

require_once 'Database.php';

session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT first_name FROM users WHERE id = :id";
$database = new Database(); 
$conn = $database->getConnection(); 
$stmt = $conn->prepare($query);
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$adminName = $user['first_name'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Solora</title>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <span>Solora</span>
        </div>
        
        <nav class="nav-links">
            <a href="#" class="nav-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
            </a>
            <a href="Product_admin.php" class="nav-item">
                <i class="fa-solid fa-dolly"></i>
                <span>Products</span>
            </a>
            <a href="customer.php" class="nav-item">
                <i class="fas fa-users"></i>
                <span>Customers</span>
            </a>
        </nav>

        <div class="logout-section">
            <a href="login.php" class="nav-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <main class="main-content">
        <header class="header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="header-right">
                <div class="profile-pic">
                    <img src="" alt="Profile">
                    <span><?php echo htmlspecialchars($adminName); ?></span>
                </div>
            </div>
        </header>

        <div class="dashboard-body">
            <div class="welcome-section">
                <h1>Overview</h1>
                <p style="color: #6b7280">Welcome back! Here's your business performance.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Total Revenue</h3>
                        <p>$0</p>
                    </div>
                    <div class="stat-icon icon-green"><i class="fas fa-dollar-sign"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>New Orders</h3>
                        <p>0</p>
                    </div>
                    <div class="stat-icon icon-orange"><i class="fas fa-shopping-basket"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Total Customers</h3>
                        <p>0</p>
                    </div>
                    <div class="stat-icon icon-blue"><i class="fas fa-users"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Active Products</h3>
                        <p>3 items</p>
                    </div>
                    <div class="stat-icon icon-purple"><i class="fas fa-clipboard-list"></i></div>
                </div>
            </div>

            <div class="data-container">
                <div class="container-header">
                    <h2 style="font-size: 18px;">Recent Orders</h2>
                    <button style="background: blueviolet; color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600;">View All</button>
                </div>
                <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Model</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#SLR-9901</td>
                            <td>John Doe</td>
                            <td>iPhone 15 Pro, 256GB - Titanium</td>
                            <td>18 Jan 2026</td>
                            <td>$1,099.00</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#SLR-9902</td>
                            <td>Sarah Smith</td>
                            <td>iPhone 14, 128GB - Blue</td>
                            <td>18 Jan 2026</td>
                            <td>$699.00</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#SLR-9903</td>
                            <td>Mike Ross</td>
                            <td>iPhone 15, 128GB - Pink</td>
                            <td>17 Jan 2026</td>
                            <td>$799.00</td>
                            <td><span class="status cancelled">Cancelled</span></td>
                        </tr>
                        <tr>
                            <td>#SLR-9904</td>
                            <td>Rachel Zane</td>
                            <td>iPhone 13, 128GB - Midnight</td>
                            <td>17 Jan 2026</td>
                            <td>$599.00</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024 && 
                !sidebar.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>