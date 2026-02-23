# 🌾 Agriculture Portal - Code Logic Explanation

---

## 📚 Table of Contents
1. [Overall Architecture](#overall-architecture)
2. [Database Setup](#database-setup)
3. [Authentication Flow](#authentication-flow)
4. [User Registration](#user-registration)
5. [Environment Configuration](#environment-configuration)
6. [UI Components](#ui-components)
7. [File Directory Structure](#file-directory-structure)

---

## Overall Architecture

### What is this project?
- **Agriculture Portal** - A platform connecting **Farmers** and **Customers**
- Farmers can sell crops directly to customers (no middlemen)
- Customers can browse and buy fresh crops
- Both have separate login/signup systems
- Uses **PHP + MySQL** backend with **Bootstrap + CSS** frontend

### Three User Types:
1. **Farmers 👨‍🌾** - Grow & sell crops, get weather/crop predictions
2. **Customers 🛒** - Buy crops, browse inventory, make payments
3. **Admin ⚙️** - Manage users, view transactions, system control

---

## Database Setup

### File: `sql.php`
**Purpose:** This is the database connection file - used in EVERY script to connect to MySQL

```
Location: Root folder
Connection to: agriculture_portal database
Database Details:
  - Host: localhost
  - User: root
  - Password: (empty by default)
  - Database Name: agriculture_portal
```

**What happens in sql.php:**
1. Loads environment variables from `.env` file (via env_config.php)
2. Connects to MySQL using mysqli_connect()
3. If connection fails, shows error message
4. Other files include this to access `$conn` variable

**Used By:** Almost every PHP file (flogin.php, customer pages, admin pages, etc.)

---

## Environment Configuration

### File: `env_config.php`
**Purpose:** Safely loads sensitive credentials from `.env` file (not shared on GitHub)

**What it does:**
- Reads the `.env` file line by line
- Parses `KEY=VALUE` pairs
- Skips comments (lines starting with `#`)
- Removes quotes from values
- Makes variables accessible via `getenv('KEY')`

**Example - How it's used:**
```php
// In sql.php
$servername = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: 'agriculture_portal';
```

**Stored in `.env`:**
```
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=agriculture_portal
OPENAI_API_KEY=sk-proj-...
NEWSAPI_KEY=40644f48...
WEATHER_API_KEY=777fdc7c...
STRIPE_SECRET_KEY=sk_test_...
```

---

## Authentication Flow

### 🔐 Login System

#### File: `farmer/floginScript.php` (and similar for customer/admin)

**What it does:**
1. User submits login form with email + password
2. Checks if `$_POST['farmerlogin']` is set (form was submitted)
3. Gets email and password from form
4. **SECURE:** Uses prepared statements to prevent SQL injection
5. Queries database for matching email + password
6. If found: Creates session and redirects to next page
7. If not found: Shows error message

**Step-by-step:**
```php
// 1. Get form data
$farmer_email = $_POST['farmer_email'];
$farmer_password = $_POST['farmer_password'];

// 2. Prepare statement (safe from SQL injection)
$stmt = $conn->prepare("SELECT * FROM farmerlogin WHERE email=? AND password=?");
$stmt->bind_param("ss", $farmer_email, $farmer_password);  // "ss" = string, string
$stmt->execute();

// 3. Get result
$result = $stmt->get_result();
$rowcount = $result->num_rows;  // How many rows found?

// 4. If user exists, start session
if ($rowcount == true) {
    $_SESSION['farmer_login_user'] = $farmer_email;  // Store email in session
    header("location: ftwostep.php");  // Go to 2-factor auth
} else {
    $error = "Username or Password is invalid";
}
```

**Session Storage:**
- `$_SESSION['farmer_login_user']` = Farmer's email (used to check if logged in)
- `$_SESSION['customer_login_user']` = Customer's email
- `$_SESSION['admin_login_user']` = Admin's email

**Two-Step Verification:**
- After login, user goes to `ftwostep.php` (check OTP)
- OTP sent to email via SMTP
- Then redirected to actual dashboard

---

## User Registration

### File: `customer/cregisterScript.php` (and similarly for farmer)

**Purpose:** Handle customer signup - validate data and insert into database

**Registration Steps:**
1. Check if form is submitted
2. Validate email (not already registered)
3. Validate password (both passwords match)
4. Create user in database
5. Show success/error message

**Key Functions:**

#### 1️⃣ Email Validation Function
```php
function is_valid_email($email) {
    // Query database: Does this email already exist?
    $stmt = $conn->prepare("SELECT cust_id FROM custlogin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Email already registered
        return false;
    } else {
        // Email is new
        return true;
    }
}
```

#### 2️⃣ Password Validation Function
```php
function is_valid_passwords($password, $cpassword) {
    // Check if both typed passwords match
    if ($password != $cpassword) {
        return false;  // Don't match
    } else {
        return true;   // Match
    }
}
```

#### 3️⃣ Create User Function
```php
function create_user($name, $password, $email, $mobile, $state, $city, $address, $pincode) {
    // Insert new customer into database
    $stmt = $conn->prepare(
        "INSERT INTO custlogin (cust_name, password, email, phone_no, state, city, address, pincode) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssssssss", $name, $password, $email, $mobile, $state, $city, $address, $pincode);
    
    if ($stmt->execute()) {
        return true;   // Success
    } else {
        return false;  // Failed
    }
}
```

**Registration Form Flow:**
```
User fills form → cregisterScript.php processes → 
Validate email not used → 
Validate passwords match → 
Insert into custlogin table → 
Show success message
```

---

## UI Components

### 🎨 Modern Design System

#### File: `assets/css/modern-glassmorphism.css`
**Purpose:** Modern green theme with glassmorphic effects

**Color Scheme:**
```css
--primary-green: #10b981       /* Main green */
--primary-dark: #059669        /* Darker green */
--secondary-bg: rgba(255, 255, 255, 0.8)  /* Glass effect */
--glass-shadow: 0 8px 32px rgba(31, 41, 55, 0.1)  /* Soft shadow */
```

**Components Styled:**
- Navbar (with logo and menus)
- Hero section (big banner with call-to-action)
- Feature boxes (3-column grid)
- Buttons (gradient and outlined)
- Forms (with modern inputs)
- Cards (with hover effects)
- Footer (with links and social media)

---

## UI Components Across Files

### 📱 Homepage
**File:** `index.php`

**Sections:**
1. **Navigation Bar** - Links to Contact, Sign Up, Login
2. **Hero Section** - "Your True Farmer's Friend" with big buttons
3. **Features Section** - What farmers/customers can do
4. **Technology Section** - Features like weather, predictions, trading
5. **Quote Section** - Pull from OpenAI ChatGPT
6. **Footer** - Links, contact info, social media

**Key Code:**
```html
<!-- Navigation Bar -->
<nav class="navbar navbar-main navbar-expand-lg navbar-light position-sticky top-0">
    <a class="navbar-brand" href="index.php">
        <i class="fas fa-leaf"></i> AgriPortal
    </a>
    <!-- Menu items -->
</nav>

<!-- Hero Section -->
<div class="hero" style="background: linear-gradient(...)">
    <h1>🌾 Your True Farmer's Friend</h1>
    <button>Get Started as Farmer</button>
    <button>Browse as Customer</button>
</div>
```

---

### 👨‍🌾 Farmer Pages Header
**Files:**
- `farmer/fheader.php` - HTML head section with CSS links
- `farmer/fnav.php` - Farmer navigation menu (sidebar/top menu)

**What's in fheader.php:**
- Bootstrap CSS (from CDN)
- Font Awesome Icons
- Modern Glassmorphism CSS
- Google Fonts
- jQuery, DataTables
- Environment variables for API keys (OpenAI, Weather, News, etc.)

**Farmer Modules (Pages):**
```
farmer/
├── flogin.php              → Login page
├── fregister.php           → Registration page
├── fprofile.php            → View/edit farmer profile
├── fstock_crop.php         → Add/manage crops for sale
├── ftradecrops.php         → Trade with customers
├── fselling_history.php    → View past sales
├── fcrop_prediction.py     → ML model for crop predictions
├── ffertilizer_recommendation.py → Fertilizer suggestions
├── fweather_forecast.php   → Weather data from API
├── fnewsfeed.php           → Agriculture news (from NewsAPI)
└── fnav.php                → Navigation menu
```

---

### 🛒 Customer Pages Header
**Files:**
- `customer/cheader.php` - HTML head section with CSS links
- `customer/cnav.php` - Customer navigation menu

**Customer Modules (Pages):**
```
customer/
├── clogin.php              → Login page
├── cregister.php           → Registration page
├── cprofile.php            → View/edit customer profile
├── cbuy_crops.php          → Browse and buy crops
├── cstock_crop.php         → View inventory of available crops
├── ccheck_price.php        → Check crop prices
├── ccheck_quantity.php     → Check stock quantity
├── cmoney_transfered.php   → Payment confirmation
├── StripePayment/          → Payment gateway folder
│   ├── stripeIPN.php       → Payment webhook
│   └── config.php          → Stripe API keys
└── cnav.php                → Navigation menu
```

---

### ⚙️ Admin Pages
**Files:**
- `admin/aheader.php` - HTML head with CSS
- `admin/anav.php` - Admin navigation

**Admin Modules:**
```
admin/
├── alogin.php              → Admin login
├── afarmers.php            → View all farmers
├── acustomers.php          → View all customers
├── aprofile.php            → Admin profile
├── aproducedcrop.php       → View all crops produced
├── aviewmsg.php            → Read contact messages
├── afdelete.php            → Delete farmer accounts
├── acdelete.php            → Delete customer accounts
└── amsgdelete.php          → Delete messages
```

---

### 📧 Footer
**File:** `footer.php`

**What's included:**
- AgriPortal branding
- Contact info (address, phone, email)
- Quick links (Contact, Farmer Login, Customer Login)
- Social media buttons (Facebook, Twitter, LinkedIn, Instagram)
- Copyright notice
- Glassmorphic glass effect with blur

**Included on:** Every page via `<?php include 'footer.php'; ?>`

---

### 📬 Contact Page
**Files:**
- `contact.php` - Contact form HTML
- `contact-script.php` - Process form + send email via SMTP

**Process:**
1. User fills name, email, message
2. Form submits to contact-script.php
3. Script sends email via Gmail SMTP (using PHPMailer)
4. Email goes to: agricultureportal05@gmail.com
5. Shows success message

---

## File Directory Structure

```
agriculture-portal-T1/
│
├── 📄 index.php                    ← HOMEPAGE (main entry point)
├── 📄 footer.php                   ← Footer (included on all pages)
├── 📄 contact.php                  ← Contact form page
├── 📄 contact-script.php           ← Contact form processor
├── 📄 sql.php                      ← DATABASE CONNECTION ⭐
├── 📄 env_config.php               ← Environment loader ⭐
├── 📄 .env                         ← Credentials (NOT on GitHub)
│
├── 📁 assets/                      ← All images, CSS, JS
│   ├── css/
│   │   ├── modern-glassmorphism.css  ← 🎨 NEW MODERN THEME
│   │   ├── creativetim.min.css       ← Bootstrap theme
│   │   ├── footer.css                ← Footer styles
│   │   ├── nucleo-icons.css          ← Icon fonts
│   │   └── nucleo-svg.css            ← SVG icons
│   ├── js/
│   │   ├── state_district_crops_dropdown.js  ← Location selector
│   │   └── TradeCrops.js             ← Trading logic
│   ├── img/                         ← Images (logo, banners)
│   └── fonts/                       ← Custom fonts
│
├── 👨‍🌾 farmer/                       ← FARMER SECTION
│   ├── fheader.php                 ← Farmer page header/CSS
│   ├── fnav.php                    ← Farmer navigation
│   ├── flogin.php                  ← Farmer login form
│   ├── floginScript.php            ← Login verification ⭐
│   ├── fregister.php               ← Farmer signup form
│   ├── fregisterScript.php         ← Signup processor ⭐
│   ├── flogout.php                 ← Logout handler
│   ├── fprofile.php                ← Farmer profile page
│   ├── fstock_crop.php             ← Add/manage crops
│   ├── ftradecrops.php             ← Trade interface
│   ├── fselling_history.php        ← Sales history
│   ├── fnewsfeed.php               ← Agriculture news
│   ├── fweather_forecast.php       ← Weather from API
│   ├── fcrop_prediction.php        ← ML crop prediction
│   ├── ffertilizer_recommendation.php ← ML fertilizer tips
│   ├── ML/                         ← Machine Learning models
│   │   ├── crop_prediction/        ← TensorFlow model
│   │   ├── crop_recommendation/    ← ML recommendation
│   │   ├── fertilizer_recommendation/ ← Fertilizer AI
│   │   ├── rainfall_prediction/    ← Rain forecasting
│   │   └── yield_prediction/       ← Crop yield AI
│   ├── static/
│   │   └── citylist.json           ← City data for dropdown
│   └── requirements.txt            ← Python dependencies
│
├── 🛒 customer/                     ← CUSTOMER SECTION
│   ├── cheader.php                 ← Customer page header/CSS
│   ├── cnav.php                    ← Customer navigation
│   ├── clogin.php                  ← Customer login form
│   ├── cloginScript.php            ← Login verification ⭐
│   ├── cregister.php               ← Customer signup form
│   ├── cregisterScript.php         ← Signup processor ⭐
│   ├── clogout.php                 ← Logout handler
│   ├── cprofile.php                ← Customer profile page
│   ├── cbuy_crops.php              ← Browse crops
│   ├── cstock_crop.php             ← View available crops
│   ├── ccheck_price.php            ← Check prices
│   ├── ccheck_quantity.php         ← Check stock
│   ├── cmoney_transfered.php       ← Payment confirmation
│   ├── StripePayment/              ← Payment gateway
│   │   ├── config.php              ← Stripe API keys
│   │   ├── pricing.php             ← Product pricing
│   │   ├── products.php            ← Product catalog
│   │   ├── stripeIPN.php           ← Payment webhook
│   │   └── stripe-php-master/      ← Stripe library
│   └── ctwostep.php                ← OTP verification
│
├── ⚙️ admin/                        ← ADMIN SECTION
│   ├── aheader.php                 ← Admin page header/CSS
│   ├── anav.php                    ← Admin navigation
│   ├── alogin.php                  ← Admin login
│   ├── aloginScript.php            ← Login verification ⭐
│   ├── alogout.php                 ← Logout handler
│   ├── aprofile.php                ← Admin profile
│   ├── afarmers.php                ← List all farmers
│   ├── acustomers.php              ← List all customers
│   ├── aproducedcrop.php           ← View all crops
│   ├── aviewmsg.php                ← View contact messages
│   ├── afdelete.php                ← Delete farmer
│   ├── acdelete.php                ← Delete customer
│   └── amsgdelete.php              ← Delete message
│
├── 📧 smtp/                        ← EMAIL SENDING
│   ├── mailer.php                  ← Send emails
│   ├── class.phpmailer.php         ← PHPMailer class
│   ├── class.smtp.php              ← SMTP connection
│   └── language/                   ← Email translations
│
├── 🗄️ db/
│   └── agriculture_portal.sql      ← Database structure (import this!)
│
└── 📚 Documentation
    ├── README.md
    ├── LICENSE
    ├── intro.md                    ← THIS FILE
    └── REMEDIATION_SUMMARY.md
```

---

## Key Security Features ✅

### Prepared Statements
All database queries use `$stmt->bind_param()` to prevent SQL injection:
```php
$stmt = $conn->prepare("SELECT * FROM farmerlogin WHERE email=? AND password=?");
$stmt->bind_param("ss", $email, $password);  // "ss" = 2 string parameters
```

### Session Management
- Sessions track logged-in users
- `$_SESSION['farmer_login_user']` stores farmer email
- Sessions invalidated on logout

### Password Handling
- Passwords stored in database (ideally should be hashed with password_hash())
- SMTP email verification via OTP

### Environment Variables
- API keys stored in `.env` (not hardcoded)
- Separated from source code on GitHub

---

## Common Code Patterns

### 1️⃣ Include Database Connection
```php
<?php
require('../sql.php');  // Gives access to $conn
?>
```

### 2️⃣ Start Session (check if logged in)
```php
<?php
session_start();
if (!isset($_SESSION['farmer_login_user'])) {
    header("location: flogin.php");  // Redirect if not logged in
}
?>
```

### 3️⃣ Query with Prepared Statement
```php
$stmt = $conn->prepare("SELECT * FROM custlogin WHERE cust_id = ?");
$stmt->bind_param("i", $id);  // "i" = integer
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
```

### 4️⃣ Insert/Update Record
```php
$stmt = $conn->prepare("UPDATE farmerlogin SET phone_no = ? WHERE email = ?");
$stmt->bind_param("ss", $phone, $email);
$stmt->execute();
```

### 5️⃣ Include Header/Footer
```php
<?php include 'fheader.php'; ?>
<!-- Page content -->
<?php include 'footer.php'; ?>
```

---

## What Needs Database Import 🗄️

**The database doesn't exist yet!**

Tables needed (in `db/agriculture_portal.sql`):
- `farmerlogin` - Farmer accounts
- `custlogin` - Customer accounts
- `adminlogin` - Admin accounts
- `crops` - Available crops
- `cart` - Shopping cart items
- `orders` - Completed purchases
- `messages` - Contact form submissions
- And more...

**How to import:**
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create new database: `agriculture_portal`
3. Import `db/agriculture_portal.sql`
4. Now login/signup will work!

---

## Summary 📝

| Component | Purpose | Location |
|-----------|---------|----------|
| **Authentication** | Login/Register users | `*/floginScript.php`, `*/fregisterScript.php` |
| **Database** | Store all data | `sql.php` connects here |
| **UI/Design** | Modern interface | `assets/css/modern-glassmorphism.css` |
| **Navigation** | Page menus | `*/fnav.php`, `*/cnav.php` |
| **Email** | Send OTP, notifications | `smtp/mailer.php` |
| **Payments** | Stripe/Razorpay | `customer/StripePayment/` |
| **ML Models** | Predictions & recommendations | `farmer/ML/` |

---

**Hope this helps! Ask questions if any section is unclear 🙂**
