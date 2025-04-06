

<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My E-Commerce Site</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #1e1e2f;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .navbar a {
            color: #f1f1f1;
            text-decoration: none;
            margin-right: 20px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .navbar a:hover {
            color: #00d4ff;
            text-decoration: underline;
        }

        .nav-left, .nav-right {
            display: flex;
            align-items: center;
        }

        .container {
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }

        .logout-btn {
            background-color: #e63946;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            margin-left: 10px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c72f3c;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .navbar a {
                margin: 8px 0;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <a href="/index.php"><strong>🏬 E-Shop</strong></a>
        <a href="/cart.php">🛒 Cart</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="/order_history.php">📦 Orders</a>
        <?php endif; ?>
    </div>
    

    <div class="nav-right">
        <?php if (isset($_SESSION['user'])): ?>
            <span style="color:#ccc;">👤 <?= $_SESSION['user'] ?></span>
            <a href="/logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <a href="/admin/admin_login.php">🔐 admin</a>
            <a href="/login.php">🔐 Login</a>
            <a href="/register.php">📝 Register</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
