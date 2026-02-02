<?php
    require_once 'Database.php';
    $database = new Database();
    
    $db = $database->getConnection();

    $sql = 'SELECT * FROM contact_messages';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/customer.css">
    <title>Solora Dashboard</title>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <span>Solora</span>
        </div>
        
        <nav class="nav-links">
            <a href="dashboard.php" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fa-solid fa-dolly"></i>
                <span>Products</span>
            </a>
            <a href="customer.php" class="nav-item active">
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
                    <span>Bardh</span>
                </div>
            </div>
        </header>
        <div class="dashboard-body">
            <div class="welcome-section">
                <h1>Messages</h1>
                <p style="color: #6b7280">Here's what our customers are saying.</p>
            </div>
            <?php if ($stmt->rowCount() > 0): ?>
            <table class="messages">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                    </tr>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['mobile']); ?></td>     
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
            </table>
            <?php else: ?>
                <p>No messages found.</p>
            <?php endif; ?>
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