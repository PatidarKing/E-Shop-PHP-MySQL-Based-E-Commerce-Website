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

<style>
    .manage-container {
        padding: 20px;
        max-width: 1000px;
        margin: auto;
    }

    .product-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f9f9f9;
        padding: 15px;
        margin: 15px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .product-info img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .product-name {
        font-size: 18px;
        font-weight: 600;
    }

    .product-price {
        color: #007b5e;
        font-weight: bold;
    }

    .action-buttons a {
        padding: 8px 12px;
        text-decoration: none;
        margin-left: 10px;
        border-radius: 5px;
        font-weight: 500;
        font-size: 14px;
        transition: 0.2s ease;
    }

    .edit-btn {
        background-color: #3498db;
        color: white;
    }

    .edit-btn:hover {
        background-color: #2c80b4;
    }

    .delete-btn {
        background-color: #e74c3c;
        color: white;
    }

    .delete-btn:hover {
        background-color: #c0392b;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
    }
</style>

<?php
include 'admin_auth.php';
include '../includes/db.php';

$res = $conn->query("SELECT * FROM products");

echo "<div class='manage-container'>";
echo "<h2>📦 Manage Products</h2>";

while ($row = $res->fetch_assoc()) {
    echo "<div class='product-card'>
        <div class='product-info'>
            <img src='../assets/images/{$row['image']}' alt='{$row['name']}'>
            <div>
                <div class='product-name'>{$row['name']}</div>
                <div class='product-price'>₹{$row['price']}</div>
            </div>
        </div>
        <div class='action-buttons'>
            <a href='edit_product.php?id={$row['id']}' class='edit-btn'>✏️ Edit</a>
            <a href='delete_product.php?id={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this product?\")'>🗑️ Delete</a>
        </div>
    </div>";
}

echo "</div>";
?>
