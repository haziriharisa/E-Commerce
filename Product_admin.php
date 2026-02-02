<?php

require_once 'Database.php';
require_once 'Product-CRUD.php';

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
    <link rel="stylesheet" href="css/products-admin.css">
    <title>Solora</title>
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
            <a href="Product_admin.php" class="nav-item active">
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
                <div class="admin-container">
        <h1 style="margin-bottom: 20px;">Product Management</h1>

        <section class="crud-form-section">
            <h3>Add New Product</h3>
            <form method="POST" class="add-form">
                <input type="text" name="title" placeholder="Model" required>
                <input type="number" step="0.01" name="price" placeholder="Price (USD)" required>
                <input type="text" name="category" placeholder="Category (IPhones)">
                <input type="text" name="image_url" placeholder="Image URL">
                <button type="submit" name="add_product" class="btn-save">Add to Inventory</button>
            </form>
        </section>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Preview</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $all_products->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td>#<?php echo $row['id']; ?></td>
                        <td><img src="<?php echo $row['image_url']; ?>" style="width:50px; border-radius:5px;"></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td>
                            <a style="font-size:14px; margin-right: 6px;" href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                            <a style="color:red; font-size:14px;" href="?action=delete&id=<?php echo $row['id']; ?>" 
                               class="btn-delete" 
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
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