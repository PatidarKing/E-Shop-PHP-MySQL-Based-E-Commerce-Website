# 🛒 E-Shop — PHP & MySQL Based E-Commerce Website

Welcome to **E-Shop**, a dynamic, responsive, and lightweight e-commerce platform built with PHP, MySQL, HTML, CSS, and JavaScript.

## 🚀 Features

### 👨‍💼 User Panel
- 🔐 User Registration & Login (Session-based)
- 🛍️ Browse Products with Search & Pagination
- 🛒 Add to Cart, Update Quantity, Remove Items
- 💸 Checkout & Order Placement
- 📦 View Order History
- 🔐 Admin Login

### 🛠️ Admin Panel
- 📋 Dashboard with Total Orders & Revenue
- ➕ Add Products with Image Upload
- 📝 Edit/Delete Products
- 📦 View All Orders from All Users
- ✅ Mark Orders as Completed
- 🔐 Admin Session Protection

---

## 🖼️ Screenshots

| Home Page | Cart Page | Admin Orders |
|----------|-----------|--------------|
| ![Home](assets/screenshots/home.png) | ![Cart](assets/screenshots/cart.png) | ![Orders](assets/screenshots/admin_orders.png) |

---

## 📁 Project Structure

```
/ecommerce-project
├── assets/
│   ├── css/
│   └── images/
├── includes/
│   ├── db.php
│   ├── header.php
│   └── footer.php
├── admin/
│   ├── admin_login.php
│   ├── admin_dashboard.php
│   ├── add_product.php
│   ├── manage_products.php
│   └── admin_orders.php
├── register.php
├── login.php
├── logout.php
├── index.php
├── cart.php
├── checkout.php
├── order_history.php
└── ...
```

---

## ⚙️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Auth:** Session-based
- **UI Enhancements:** Responsive Design, Loader, Pagination

---

## 📦 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/PatidarKing/ecommerce-project.git
   ```

2. **Import the Database**
   - Import `ecommerce.sql` into your local MySQL server using phpMyAdmin or command line.

3. **Configure Database Connection**
   - Edit `includes/db.php` and set your DB credentials:
     ```php
     $conn = new mysqli("localhost", "root", "", "ecommerce");
     ```

4. **Run Locally**
   - Use [XAMPP](https://www.apachefriends.org/) or [Laragon](https://laragon.org/) to run PHP and MySQL.
   - Access via: `http://localhost/ecommerce-project`

---

## 🧪 Test Credentials

### 👨‍🦱 User:
- Email: `test@eshop.com`
- Password: `123456`

### 👨‍💼 Admin:
- Email: `admin@eshop.com`
- Password: `admin123`

---

## 🛡️ Security Notes
- Passwords should be hashed using `password_hash()` and verified with `password_verify()`.
- Admin routes are protected with session authentication.
- User inputs are sanitized to prevent SQL injection.

---

## 📈 Future Improvements
- ✅ Add coupon/discount system
- ✅ Payment gateway integration
- ✅ Product ratings and reviews
- ✅ Email notifications for orders
- ✅ Docker setup

---

## 🧑‍💻 Author

**Ved**  
📫 [Connect on LinkedIn](https://www.linkedin.com/in/ved-patel-70913a292?)  

