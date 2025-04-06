<?php
session_start();
include 'includes/header.php'; // Include your header/navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .about-container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      line-height: 1.7;
    }
    .about-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .about-container p {
      font-size: 17px;
      color: #555;
    }
    .team {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }
    .member {
      text-align: center;
      width: 200px;
      padding: 15px;
      border-radius: 10px;
      background-color: #f1f1f1;
    }
    .member img {
      border-radius: 50%;
      width: 100px;
      height: 100px;
      object-fit: cover;
      margin-bottom: 10px;
    }
    .member h4 {
      margin: 10px 0 5px;
    }
  </style>
</head>
<body>

<div class="about-container">
  <h2>About Our Store</h2>
  <p>
    Welcome to our online store! We are passionate about providing high-quality products at affordable prices. Our mission is to make online shopping simple, secure, and enjoyable for everyone.
  </p>

  <p>
    From electronics to fashion and home essentials, we carefully curate our inventory to bring you the best options available. Our platform is easy to use, and we are always ready to assist you with your orders or questions.
  </p>

  <div class="team">
    <div class="member">
      <img src="assets/images/motor.webp" alt="Founder">
      <h4>Ved</h4>
      <p>Founder & Developer</p>
    </div>
    <div class="member">
      <img src="assets/images/leds.jpg" alt="Support">
      <h4>Nayan</h4>
      <p>Customer Support</p>
    </div>
    <div class="member">
      <img src="assets/images/motor.webp" alt="Marketing">
      <h4>Dutt</h4>
      <p>Marketing Head</p>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
