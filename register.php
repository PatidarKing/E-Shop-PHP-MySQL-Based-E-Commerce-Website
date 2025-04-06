<?php
session_start();
include 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $error = "⚠️ Email already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $pass);
        if ($stmt->execute()) {
            $_SESSION['user'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Registration failed. Try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="login_style.css">
</head>
<body>

<div class="login-box">
  <h2>Register</h2>
  <?php if ($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>
  <form method="POST">
    <input type="text" name="name" required placeholder="👤 Name">
    <input type="email" name="email" required placeholder="📧 Email">
    <input type="password" name="password" required placeholder="🔒 Password">
    <button type="submit">📝 Register</button>
  </form>
</div>

</body>
</html>
