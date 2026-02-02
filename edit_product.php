<?php
include_once 'Database.php';
include_once 'Product-CRUD.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$id = $_GET['id'];
$row = $product->readOne($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product->update($id, $_POST['title'], $_POST['price'], $_POST['category'], $_POST['image_url']);
    header("Location: Product_admin.php?msg=updated");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/edit.css"> <title>Edit <?php echo htmlspecialchars($data['title']); ?></title>
</head>
<body>
    <div class="admin-container">
        <div class="crud-form-section">

           <form method="POST" class="add-form">
                <h3>Edit <?php echo htmlspecialchars($row['title']); ?></h3>
                <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
                <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>">
                <input type="text" name="category" value="<?php echo htmlspecialchars($row['category']); ?>">
                <input type="text" name="image_url" value="<?php echo htmlspecialchars($row['image_url']); ?>">
                <button type="submit" class="btn-save">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>