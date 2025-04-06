<?php
session_start();
include 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Invalid password.";
        }
    } else {
        $error = "❌ User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login_style.css">
</head>
<body>

<div class="login-box">
  <h2>Login</h2>
  <?php if ($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>
  <form method="POST">
    <input type="email" name="email" placeholder="📧 Email" required>
    <input type="password" id="password" name="password" placeholder="🔒 Password" required>
    <label class="show-password">
      <input type="checkbox" onclick="togglePassword()"> Show Password
    </label>
    <button type="submit">🔓 Login</button>
  </form>
</div>
<script>
function togglePassword() {
  var passField = document.getElementById("password");
  passField.type = passField.type === "password" ? "text" : "password";
}
</script>
</body>
</html>
