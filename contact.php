<?php
session_start();
include 'includes/db.php';

$siteKey = 'YOUR_SITE_KEY'; // Replace with your reCAPTCHA site key
$secretKey = 'YOUR_SECRET_KEY'; // Replace with your reCAPTCHA secret key

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);
    $captcha = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $captchaSuccess = json_decode($verify)->success;

    if ($captchaSuccess) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();

        $success = "✅ Your message has been sent successfully!";
    } else {
        $error = "❌ CAPTCHA verification failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .contact-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="contact-container">
    <h2>📬 Contact Us</h2>

    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="👤 Your Name" required>
        <input type="email" name="email" placeholder="📧 Your Email" required>
        <textarea name="message" rows="5" placeholder="💬 Your Message" required></textarea>

        <div class="g-recaptcha" data-sitekey="<?= $siteKey ?>"></div>

        <br>
        <button class="btn" type="submit">Send Message</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
