<link rel="stylesheet" href="admin_style.css">

<?php
include 'admin_auth.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$img");

    $stmt = $conn->prepare("INSERT INTO products (name, price, image, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $img, $desc);
    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product.";
    }
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

<h2>Add Product</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" required placeholder="Product Name"><br>
    <input type="number" step="0.01" name="price" required placeholder="Price"><br>
    <input type="file" name="image" required><br>
    <textarea name="description" required placeholder="Description"></textarea><br>
    <button type="submit">Add Product</button>
</form>
