<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['user'];
$sql = "SELECT orders.*, products.name, products.price 
        FROM orders 
        JOIN products ON orders.product_id = products.id 
        WHERE user_email='$email' 
        ORDER BY order_date DESC";

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f8;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .order {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .order:last-child {
            border-bottom: none;
        }
        .order strong {
            color: #111;
            font-size: 18px;
        }
        .order-details {
            margin-top: 5px;
            font-size: 15px;
            color: #555;
        }
        .empty-message {
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Your Order History</h2>

    <?php
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $total = $row['price'] * $row['quantity'];
            echo "<div class='order'>
                    <strong>{$row['name']}</strong>
                    <div class='order-details'>
                        ₹{$row['price']} x {$row['quantity']} = <strong>₹$total</strong><br>
                        Ordered on: {$row['order_date']}
                    </div>
                </div>";
        }
    } else {
        echo "<p class='empty-message'>No orders found.</p>";
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
