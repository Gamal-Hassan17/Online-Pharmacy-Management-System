# Online Pharmacy Management System

## Overview

The Online Pharmacy Management System is a web-based application developed to provide customers with an easy and secure way to browse medicines, manage shopping carts, and place orders online.

The system also provides an administration dashboard that allows administrators to manage products, categories, users, comments, and customer orders efficiently.

---

## System Objectives

- Provide an online platform for purchasing medicines
- Reduce manual pharmacy operations
- Improve order management and tracking
- Organize products into categories
- Allow administrators to manage the entire system
- Improve customer experience through a responsive interface

---

## Features

### Customer Features

- User Registration and Login
- Browse Products by Categories
- Product Search Functionality
- Product Details Page
- Shopping Cart System
- Checkout and Order Placement
- Order History
- Product Reviews and Comments

### Admin Features

- Admin Dashboard
- Product Management (CRUD)
- Category Management
- User Management
- Order Management
- Comment Moderation
- Sales and Statistics Reporting

---

## System Architecture

The system follows a Three-Tier Architecture:

### 1. Presentation Layer

- HTML
- Bootstrap
- jQuery

Responsible for:

- User Interface
- Responsive Design
- Client-side interactions

### 2. Application Layer

- PHP / Laravel

Responsible for:

- Business Logic
- Authentication & Authorization
- Session Management
- Data Validation

### 3. Data Layer

- MySQL Database

Responsible for:

- Data Storage
- Data Retrieval
- Relationships and Constraints

---

## Technologies Used

| Technology    | Purpose              |
| ------------- | -------------------- |
| PHP / Laravel | Backend Development  |
| MySQL         | Database             |
| HTML5         | Structure            |
| CSS3          | Styling              |
| Bootstrap     | Responsive UI        |
| JavaScript    | Frontend Logic       |
| jQuery        | Dynamic Interactions |

---

## Database Tables

### Main Tables

- users
- categories
- products
- orders
- order_items
- comments
- cart_items (optional)

---

## Entity Relationships

- One User can place many Orders
- One Order contains many Order Items
- One Category contains many Products
- One Product can have many Comments
- One User can write many Comments

---

## Main Modules

### Authentication Module

- Register
- Login
- Logout
- Role Management

### Product Management Module

- Add Product
- Edit Product
- Delete Product
- Search Products

### Cart Module

- Add to Cart
- Update Quantity
- Remove Items

### Order Management Module

- Create Orders
- Update Order Status
- View Order History

### User Management Module

- Manage Users
- Activate/Deactivate Accounts
- Assign Roles

### Reporting Module

- Revenue Reports
- Order Statistics
- Low Stock Alerts

---

## Customer Pages

- Home Page
- Product List
- Product Details
- Shopping Cart
- Checkout
- Login/Register
- Order History

---

## Administrator Pages

- Dashboard
- Manage Products
- Manage Categories
- Manage Orders
- Manage Users
- Manage Comments

---

## Installation

### Clone the Repository

```bash
git clone https://github.com/your-username/online-pharmacy-system.git
```

### Enter Project Directory

```bash
cd online-pharmacy-system
```

### Install Dependencies

```bash
composer install
```

### Create Environment File

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Configure Database

Update your `.env` file:

```env
DB_DATABASE=pharmacy
DB_USERNAME=root
DB_PASSWORD=
```

### Run Migrations

```bash
php artisan migrate
```

### Start Development Server

```bash
php artisan serve
```

---

## Security Features

- Password Hashing
- Authentication Middleware
- Session Protection
- Input Validation
- CSRF Protection
- Role-Based Access Control

---

## Order Workflow

1. Customer browses products
2. Adds products to cart
3. Proceeds to checkout
4. Places order
5. Admin processes order
6. Order status updated
7. Customer receives confirmation

---

## Future Improvements

- Online Payment Gateway Integration
- Email Notifications
- Delivery Tracking
- Mobile Application
- AI-based Product Recommendations
- Advanced Sales Analytics

---

## Project Structure

```bash
app/
database/
public/
resources/
routes/
storage/
```

---

## Screenshots

### Home Page

(Add Screenshot Here)

### Admin Dashboard

(Add Screenshot Here)

### Product Page

(Add Screenshot Here)

---

## Team Members

- Gamal Hassan
- Your Team Members

---

## Academic Information

Faculty of Computers and Information  
Tanta University

---

## License

This project is developed for educational purposes.
