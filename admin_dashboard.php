<?php
include 'admin_auth.php';
include '../includes/db.php';

$query = "SELECT DATE(order_date) as order_day, COUNT(*) as total_orders 
          FROM orders 
          GROUP BY DATE(order_date) 
          ORDER BY order_day ASC";
$result = mysqli_query($conn, $query);

$dates = [];
$orderCounts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = $row['order_day'];
    $orderCounts[] = $row['total_orders'];
}

$revenueQuery = "SELECT DATE(order_date) as order_day, 
                        SUM(p.price * o.quantity) as total_revenue 
                 FROM orders o 
                 JOIN products p ON o.product_id = p.id 
                 GROUP BY DATE(order_date) 
                 ORDER BY order_day ASC";

$revenueDates = [];
$revenues = [];
$res = mysqli_query($conn, $revenueQuery);

while ($row = mysqli_fetch_assoc($res)) {
    $revenueDates[] = $row['order_day'];
    $revenues[] = $row['total_revenue'];
}

$productSalesQuery = "SELECT p.name, SUM(o.quantity) as qty_sold 
                      FROM orders o 
                      JOIN products p ON o.product_id = p.id 
                      GROUP BY p.name";

$productNames = [];
$quantities = [];
$res = mysqli_query($conn, $productSalesQuery);

while ($row = mysqli_fetch_assoc($res)) {
    $productNames[] = $row['name'];
    $quantities[] = $row['qty_sold'];
}
?>

<link rel="stylesheet" href="admin_style.css">
<div class="header">
  <h1>Admin Panel</h1>
  <div class="nav-links">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="add_product.php">Add Product</a>
    <a href="manage_products.php">Manage Products</a>
    <a href="admin_orders.php">Orders</a>
    <a class="logout" href="admin_logout.php">Logout</a>
  </div>
</div>

<h2>Welcome Admin!</h2>

<div class="card">
  <h3>Orders Overview</h3>
  <canvas id="ordersChart" width="400" height="200"></canvas>
</div>
<div class="card">
  <h3>Revenue Overview</h3>
  <canvas id="revenueChart" width="400" height="200"></canvas>
</div>
<div class="card">
  <h3>Product Sales Distribution</h3>
  <canvas id="salesPie" width="400" height="200"></canvas>
</div>

<!-- ✅ Proper Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ordersCtx = document.getElementById('ordersChart').getContext('2d');
new Chart(ordersCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode($dates) ?>,
        datasets: [{
            label: 'Total Orders',
            data: <?= json_encode($orderCounts) ?>,
            backgroundColor: 'rgba(40, 167, 69, 0.2)',
            borderColor: 'rgba(40, 167, 69, 1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Orders per Day'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($revenueDates) ?>,
        datasets: [{
            label: 'Total Revenue (₹)',
            data: <?= json_encode($revenues) ?>,
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Revenue per Day'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const pieCtx = document.getElementById('salesPie').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: <?= json_encode($productNames) ?>,
        datasets: [{
            data: <?= json_encode($quantities) ?>,
            backgroundColor: [
                '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8',
                '#6f42c1', '#20c997', '#fd7e14'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Product Sales Breakdown'
            }
        }
    }
});
</script>
