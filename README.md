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
<img width="1878" height="913" alt="Main Page" src="https://github.com/user-attachments/assets/df15efd0-506f-4459-987c-dc49d36a8b15" />


### Products Catalog
<img width="1919" height="907" alt="Products" src="https://github.com/user-attachments/assets/4e4c05ec-781c-40a5-9c9b-03e64cd5ab8a" />


### Product Detail
<img width="1901" height="898" alt="Product" src="https://github.com/user-attachments/assets/650e0a54-cc43-4854-a8fb-d0e2628b0f1a" />


### Checkout
<img width="1692" height="794" alt="Cart" src="https://github.com/user-attachments/assets/b417cf04-1690-4d5f-944d-71e50c36799e" />


### Contact
<img width="1877" height="901" alt="Contact me" src="https://github.com/user-attachments/assets/002e8df5-54fb-4267-ad4a-7aec592b2c25" />


### Admin Login
<img width="1714" height="804" alt="Admin Login" src="https://github.com/user-attachments/assets/90d50164-5f97-4b4e-9927-1cfb82761bef" />


### Admin Dashboard
<img width="1680" height="804" alt="Admin Dashboard" src="https://github.com/user-attachments/assets/0bf4fd94-da30-482b-a969-6dc8683e9402" />


### Admin — Products Table (Yajra DataTables)
<img width="1689" height="802" alt="Admin Dashboard 2" src="https://github.com/user-attachments/assets/ed236b14-e394-457c-832e-50afa58743ac" />


### Admin — Orders Table
<img width="1687" height="785" alt="Admin Dashboard 3" src="https://github.com/user-attachments/assets/e1355543-4bdd-4eca-91c9-3e1c31fe2058" />


### Admin — Customers Table
<img width="1681" height="801" alt="image" src="https://github.com/user-attachments/assets/ee82cb4b-1321-4128-ac6b-b5ef942e0b10" />


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
