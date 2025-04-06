<?php
session_start();
include 'includes/db.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['qty'] as $id => $q) {
        $_SESSION['cart'][$id] = max(1, (int)$q); // Prevent 0 or negative
    }
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link rel="stylesheet" href="cart_style.css">
  <link rel="stylesheet" href="../assetes/css/style.css">
  <style>
      .continue-btn {
    display: inline-block;
    background-color: #17a2b8;
    color: white;
    padding: 10px 16px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    margin-left: 10px;
  }
  
  .continue-btn:hover {
    background-color: #138496;
  }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="cart-container">
  <h2>Your Cart</h2>

  <?php if (empty($cart)): ?>
    <p class="empty-msg">🛒 Your cart is empty.</p>
  <?php else: ?>
    <form method="post">
      <?php foreach ($cart as $id => $qty): 
        $res = $conn->query("SELECT * FROM products WHERE id=$id");
        $product = $res->fetch_assoc();
        $subtotal = $product['price'] * $qty;
        $total += $subtotal;
      ?>
      <div class="cart-item">
        <img src="assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <div class="details">
          <h3><?= $product['name'] ?></h3>
          <p>₹<?= $product['price'] ?> x 
            <input type="number" name="qty[<?= $id ?>]" value="<?= $qty ?>" min="1" class="qty-input"> = 
            <strong>₹<?= $subtotal ?></strong>
          </p>
          <a href="remove_from_cart.php?id=<?= $id ?>" class="remove-btn">❌ Remove</a>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="cart-summary">
  <h3>Total: ₹<?= $total ?></h3>
  <button type="submit" class="update-btn">🔄 Update Cart</button>
  <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
  <a href="index.php" class="continue-btn">⬅️ Continue Shopping</a>
</div>

    </form>
  <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
