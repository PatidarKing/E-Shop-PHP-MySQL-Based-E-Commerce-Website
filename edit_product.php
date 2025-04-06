<?php
include 'admin_auth.php';
include '../includes/db.php';

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    // Handle image if updated
    if (!empty($_FILES['image']['name'])) {
        $img = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$img");
        $conn->query("UPDATE products SET name='$name', price=$price, image='$img', description='$desc' WHERE id=$id");
    } else {
        $conn->query("UPDATE products SET name='$name', price=$price, description='$desc' WHERE id=$id");
    }

    echo "Product updated!";
}
?>
<div class="header">
  <h1>Admin Panel</h1>
  <div class="nav-links">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="add_product.php">Add Product</a>
    <a href="manage_products.php">Manage Products</a>
    <a href="admin_orders.php">Orders</a>
    <a class="logout" href="admin_logout.php">Logout</a>
  </div>
</div>
<link rel="stylesheet" href="admin_style.css">

<h2>Edit Product</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $product['name'] ?>" required><br>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required><br>
    <img src="../assets/images/<?= $product['image'] ?>" width="100"><br>
    <input type="file" name="image"><br>
    <textarea name="description" required><?= $product['description'] ?></textarea><br>
    <button type="submit">Update</button>
</form>
