<?php
session_start();
include 'includes/db.php';

$search = $_GET['search'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

// Escape search input
$search_escaped = $conn->real_escape_string($search);
$search_sql = !empty($search) ? "WHERE name LIKE '%$search_escaped%' OR description LIKE '%$search_escaped%'" : "";

// Get total products for pagination
$total_result = $conn->query("SELECT COUNT(*) AS total FROM products $search_sql");
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Fetch current page products
$sql = "SELECT * FROM products $search_sql LIMIT $offset, $limit";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My E-Commerce Site</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta http-equiv="refresh" content="60">
    <style>
        .search-box {
            text-align: center;
            margin: 20px auto;
        }
        .search-box input[type="text"] {
            padding: 8px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .search-box button {
            padding: 8px 12px;
            margin-left: 5px;
            border-radius: 5px;
            border: none;
            background-color: #00d4ff;
            color: #000;
            cursor: pointer;
        }
        .search-box button:hover {
            background-color: #00bcd4;
        }
        .product-list {
            display: none;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 10px;
        }
        .loader {
            text-align: center;
            margin: 30px auto;
        }
        .pagination {
            text-align: center;
            margin: 20px;
        }
        .pagination a {
            margin: 0 5px;
            padding: 6px 12px;
            border: 1px solid #ccc;
            text-decoration: none;
            border-radius: 5px;
            background-color: #f1f1f1;
            color: #000;
        }
        .pagination a.active {
            background-color: #00d4ff;
        }
          /* 🔄 Preloader Style */
          #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader-spinner {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #00d4ff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        body.loaded #preloader {
            display: none;
        }
    </style>
</head>
<body>
    <!-- 🔄 Preloader -->
<div id="preloader">
    <div class="loader-spinner"></div>
</div>
<div class="wrapper">
    <?php include 'includes/header.php'; ?>

    <div class="content">
        <h2 style="text-align:center;">🛒 All Products</h2>

        <!-- ✅ Search Box -->
        <form method="GET" id="searchForm" class="search-box">
            <input type="text" name="search" placeholder="🔍 Search products..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Search</button>
            <button type="button" onclick="window.location='index.php'" style="background:#ccc;">Reset</button>
        </form>

        <!-- ✅ Loader -->
        <div class="loader" id="loader">
            <img src="assets/images/loader.gif" alt="Loading..." width="50">
        </div>

        <!-- ✅ Product List -->
        <div class="product-list" id="productList">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="product">
                        <img src="assets/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <h3><?php echo $row['name']; ?></h3>
                        <p>₹<?php echo $row['price']; ?></p>
                        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">Add to Cart</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='text-align:center;'>❌ No products found.</p>";
            }
            ?>
        </div>

        <!-- ✅ Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a class="<?= ($i == $page) ? 'active' : '' ?>" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- ✅ Loader Script -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const loader = document.getElementById("loader");
        const productList = document.getElementById("productList");

        loader.style.display = "block";
        setTimeout(() => {
            loader.style.display = "none";
            productList.style.display = "flex";
        }, 1000); // Simulate 1-second loading
    });
</script>
<script>
    // Show page only after it fully loads
    window.addEventListener("load", () => {
        document.body.classList.add("loaded");
    });
</script>

</body>
</html>
