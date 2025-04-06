<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$email = $_SESSION['user'];

foreach ($cart as $id => $qty) {
    $stmt = $conn->prepare("INSERT INTO orders (user_email, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $email, $id, $qty);
    $stmt->execute();
}

unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Placed</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
        }
        h2 {
            color: #2e7d32;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        a {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #2e7d32;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        a:hover {
            background-color: #256428;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>🎉 Order Placed Successfully!</h2>
    <p>Thank you for your purchase. You can check your order history below.</p>
    <a href="order_history.php">View Order History</a>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
