<?php
session_start();
include 'includes/header.php'; // Include site header
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Privacy Policy</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .privacy-container {
      max-width: 900px;
      margin: 40px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      line-height: 1.7;
      font-size: 16px;
      color: #333;
    }
    .privacy-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #222;
    }
    .privacy-container h3 {
      margin-top: 20px;
      color: #007bff;
    }
    .privacy-container ul {
      padding-left: 20px;
    }
  </style>
</head>
<body>

<div class="privacy-container">
  <h2>Privacy Policy</h2>
  <p>At <strong>Your E-Commerce Website</strong>, we take your privacy seriously. This policy describes how we collect, use, and protect your personal information.</p>

  <h3>1. Information We Collect</h3>
  <ul>
    <li>Personal details (name, email, address) when you register or place an order</li>
    <li>Payment details through secure payment gateways</li>
    <li>Usage data including browser, IP address, and device type</li>
  </ul>

  <h3>2. How We Use Your Information</h3>
  <ul>
    <li>To process and ship your orders</li>
    <li>To communicate order status and updates</li>
    <li>To improve user experience and website functionality</li>
  </ul>

  <h3>3. Data Protection</h3>
  <p>We use encryption and secure servers to protect your data. Your personal information is never sold or shared with third parties without your consent.</p>

  <h3>4. Cookies</h3>
  <p>We use cookies to enhance your browsing experience. You can disable cookies in your browser settings, though this may affect site functionality.</p>

  <h3>5. Your Rights</h3>
  <p>You may request access, correction, or deletion of your personal information at any time by contacting us.</p>

  <h3>6. Changes to This Policy</h3>
  <p>We may update this Privacy Policy from time to time. Please review it periodically.</p>

  <p>If you have any questions or concerns, please <a href="contact.php">contact us</a>.</p>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
