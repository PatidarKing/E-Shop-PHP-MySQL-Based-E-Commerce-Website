<link rel="stylesheet" href="admin_style.css">
<?php
session_start();
include '../includes/db.php'; // assuming admin folder is separate

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND role='admin'");
    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['admin'] = $email;
            header("Location: admin_dashboard.php");
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "Unauthorized access";
    }
}

?>



<!-- Simple Login Form -->
<h2>Admin Login</h2>
<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
    <input type="email" name="email" required placeholder="Admin Email"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <button type="submit">Login</button>
</form>
