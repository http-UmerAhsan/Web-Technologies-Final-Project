<div align="center">

<img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" width="80" alt="Nike Logo">

# Nike Pakistan — Shoe Store

**A full-stack e-commerce shoe store built with Laravel 10**

[![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![DataTables](https://img.shields.io/badge/Yajra-DataTables-0099CC?style=for-the-badge)](https://yajrabox.com/docs/laravel-datatables)

[Features](#-features) · [Screenshots](#-screenshots) · [Setup](#-quick-setup) · [Admin Panel](#-admin-panel) · [Contact](#-contact)

</div>

---

## 📖 About

Nike Pakistan is a complete, production-ready e-commerce store built as a full Laravel MVC application. It includes a public-facing shoe store with cart and checkout, and a fully featured admin dashboard — all prices in **Pakistani Rupees (PKR)**.

Built with **Laravel 10**, **MySQL**, **Yajra DataTables**, and **Laravel Mail**.

---

## ✨ Features

### 🛍️ Store
| Feature | Description |
|---|---|
| **Home Page** | Hero section, featured products from DB, category browsing, animated marquee |
| **Products Catalog** | 12 Nike shoes with category filter, price range, and sort (price / newest) |
| **Product Detail** | Image gallery, size selector, color swatches, quantity picker, add to bag |
| **Session Cart** | Add/update/remove items, live badge counter, free shipping over Rs. 15,000 |
| **Checkout** | 3-step form with Card / Easypaisa / Cash on Delivery payment options |
| **Order Confirmation** | Success page + automated email sent via Laravel Mail |
| **Contact Form** | Server-validated, sends real email to developer via Gmail SMTP |

### 🔐 Admin Panel
| Feature | Description |
|---|---|
| **Secure Login** | Session-based auth with `AdminAuth` middleware protecting all `/admin/*` routes |
| **Dashboard** | Live stats — total revenue, orders, products, customers |
| **Products CRUD** | Create, edit, delete products with all fields |
| **Orders Table** | View all orders, update status (Pending → Processing → Shipped → Delivered) |
| **Order Items Table** | All line items linked to their parent orders |
| **Customers Table** | All users who placed orders with spend totals |
| **Yajra DataTables** | Server-side search, sort, and pagination on every admin table |

### ✅ Validation
- Server-side validation on all forms via Laravel `Request` rules
- Specific error messages per field with Pakistani phone format validation
- Card number, expiry (future dates only), and CVV validation
- Email format validation throughout

---

## 📸 Screenshots

### Home Page
![Home Page](screenshots/home.png)

### Products Catalog
![Products](screenshots/products.png)

### Product Detail
![Product Detail](screenshots/product-detail.png)

### Checkout
![Checkout](screenshots/checkout.png)

### Contact
![Contact](screenshots/contact.png)

### Admin Login
![Admin Login](screenshots/admin-login.png)

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)

### Admin — Products Table (Yajra DataTables)
![Admin Products](screenshots/admin-products.png)

### Admin — Orders Table
![Admin Orders](screenshots/admin-orders.png)

### Admin — Customers Table
![Admin Users](screenshots/admin-users.png)

---

## ⚡ Quick Setup

### Requirements
- PHP 8.1+
- Composer
- MySQL 8.0+

### Steps

**1. Install dependencies**
```bash
composer install
```

**2. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

**3. Set your database credentials in `.env`**
```env
DB_DATABASE=nike_pakistan
DB_USERNAME=root
DB_PASSWORD=your_password
```

**4. Run migrations and seed data**
```bash
php artisan migrate --seed
```
> Seeds **12 Nike products**, **8 sample orders**, and **8 sample customers** automatically.

**5. Start the server**
```bash
php artisan serve
```

Visit → **http://localhost:8000**

---

## 📧 Email Setup (Optional)

To enable order confirmation emails and the contact form, add your Gmail App Password to `.env`:

```env
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your_gmail_app_password
```

> Get a Gmail App Password at: [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)

---

## 🔐 Admin Panel

Access the admin panel at **`/admin/login`**.

Admin credentials are set in your `.env` file:

```env
ADMIN_USERNAME=YourUsername
ADMIN_PASSWORD=YourPassword
```

> All `/admin/*` routes are protected by the `AdminAuth` middleware — unauthenticated users are redirected to the login page automatically.

---

## 🗃️ Database Schema

```
products     — id, name, subtitle, category, price, old_price, description,
               rating, stock, badge, colors (JSON), sizes (JSON), images (JSON)

orders       — id, order_number, customer_name, customer_email, customer_phone,
               address, city, province, postal_code, payment_method,
               subtotal, shipping, tax, total, status

order_items  — id, order_id, product_id, product_name, size, color,
               quantity, unit_price, total_price

customers    — id, name, email, phone, city, province, total_orders, total_spent
```

---

## 📁 Project Structure

```
nike-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          ← Auth, Dashboard, Products, Orders, Users
│   │   │   ├── ShopController  ← Home, Products, Single product
│   │   │   ├── CartController  ← Session cart (add / update / remove)
│   │   │   ├── OrderController ← Checkout, placement, success page
│   │   │   └── ContactController
│   │   └── Middleware/
│   │       └── AdminAuth.php   ← Protects all /admin/* routes
│   ├── Mail/
│   │   ├── OrderConfirmationMail.php
│   │   └── ContactMail.php
│   └── Models/
│       └── Product · Order · OrderItem · Customer
├── database/
│   ├── migrations/             ← 4 migration files
│   └── seeders/DatabaseSeeder.php
├── resources/views/
│   ├── layouts/                ← app.blade.php, admin.blade.php
│   ├── shop/                   ← home, products, show, cart, checkout, success
│   ├── admin/                  ← dashboard, products CRUD, orders, users
│   ├── auth/login.blade.php
│   ├── contact/index.blade.php
│   └── emails/                 ← order-confirmation, contact
├── routes/web.php
├── public/css/app.css
├── public/js/app.js
└── screenshots/
```

---

## 🛣️ Routes Overview

```
# Public Store
GET  /                      Home page
GET  /products              Products catalog
GET  /products/{id}         Single product
GET  /cart                  Cart page
POST /cart/add              Add to cart (AJAX)
GET  /checkout              Checkout form
POST /checkout              Place order
GET  /order/success/{id}    Order success
GET  /contact               Contact page
POST /contact               Send email

# Admin (protected by AdminAuth middleware)
GET  /admin/login           Login page
POST /admin/login           Authenticate
GET  /admin                 Dashboard
GET  /admin/products        Products DataTable
POST /admin/products        Create product
PUT  /admin/products/{id}   Update product
DEL  /admin/products/{id}   Delete product
GET  /admin/orders          Orders DataTable
GET  /admin/orders/{id}     Order detail + status update
GET  /admin/order-items     Order items DataTable
GET  /admin/users           Customers DataTable
```

---

## 📬 Contact

**Umer Ahsan**

- 📧 [umerahsan696@gmail.com](mailto:umerahsan696@gmail.com)
- 🐙 [github.com/http-UmerAhsan](https://github.com/http-UmerAhsan)

---

<div align="center">

Built with ❤️ using **Laravel 10** · Pakistan 🇵🇰 · 2025

*This project is for educational and portfolio purposes. Nike® is a registered trademark of Nike, Inc.*

</div>
