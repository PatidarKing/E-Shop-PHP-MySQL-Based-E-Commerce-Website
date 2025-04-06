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

<?php
include 'admin_auth.php';
include '../includes/db.php';

// ✅ Handle order completion request
if (isset($_POST['mark_done']) && isset($_POST['order_id'])) {
    $order_id = (int)$_POST['order_id'];
    $conn->query("UPDATE orders SET status = 'completed' WHERE id = $order_id");
}

// ✅ Fetch orders and group by users
$sql = "SELECT orders.*, products.name AS product_name, products.price, users.email 
        FROM orders 
        JOIN products ON orders.product_id = products.id
        JOIN users ON orders.user_email = users.email
        ORDER BY users.email, order_date DESC";

$res = $conn->query($sql);

$totalRevenue = 0;
$totalOrders = $res->num_rows;

$ordersByUser = [];

while ($row = $res->fetch_assoc()) {
    $ordersByUser[$row['email']][] = $row;
}

echo "<h2>All Orders (Grouped by User)</h2>";

foreach ($ordersByUser as $email => $orders) {
    echo "<div style='margin-bottom: 30px; padding: 15px; border: 2px solid #444; border-radius: 10px; background: #f9f9f9;'>
        <h3>📧 $email</h3>";

    foreach ($orders as $order) {
        $subtotal = $order['price'] * $order['quantity'];
        $totalRevenue += $subtotal;

        echo "<div style='margin: 10px 0; padding: 10px; border: 1px solid #ddd; border-radius: 8px; background: #fff;'>
            <strong>{$order['product_name']}</strong><br>
            ₹{$order['price']} x {$order['quantity']} = ₹$subtotal<br>
            Date: {$order['order_date']}<br>
            Status: <strong>" . ucfirst($order['status']) . "</strong><br>";

        if ($order['status'] !== 'completed') {
            echo "
            <form method='post' style='margin-top: 10px;'>
                <input type='hidden' name='order_id' value='{$order['id']}'>
                <button type='submit' name='mark_done'>Mark as Done</button>
            </form>";
        } else {
            echo "✅ Order Completed";
        }

        echo "</div>";
    }

    echo "</div>";
}

echo "<h3>Total Orders: $totalOrders</h3>";
echo "<h3>Total Revenue: ₹$totalRevenue</h3>";
?>
