<?php
session_start();
include 'includes/db.php';


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
if ($row['role'] == 'admin') {
    $_SESSION['admin'] = true;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['user'];
    $old = $_POST['old_password'];
    $new = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $res->fetch_assoc();

    if (password_verify($old, $user['password'])) {
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
        $stmt->bind_param("ss", $new, $email);
        if ($stmt->execute()) {
            echo "Password changed successfully.";
        } else {
            echo "Update failed.";
        }
    } else {
        echo "Old password incorrect.";
    }
}
?>

<!-- HTML form -->
<form method="POST">
    <input type="password" name="old_password" required placeholder="Current Password"><br>
    <input type="password" name="new_password" required placeholder="New Password"><br>
    <button type="submit">Change Password</button>
</form>
