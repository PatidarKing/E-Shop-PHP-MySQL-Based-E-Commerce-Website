<?php
include 'admin_auth.php';
include '../includes/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM products WHERE id=$id");

header("Location: manage_products.php");
?>
<link rel="stylesheet" href="admin_style.css">

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
