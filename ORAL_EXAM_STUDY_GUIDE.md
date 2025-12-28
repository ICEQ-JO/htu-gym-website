# HTU GYM Website - Complete Oral Exam Study Guide

## Table of Contents
1. [Project Overview](#project-overview)
2. [File Structure](#file-structure)
3. [Database Architecture](#database-architecture)
4. [HTML Pages Explained](#html-pages-explained)
5. [CSS Styling System](#css-styling-system)
6. [JavaScript Functionality](#javascript-functionality)
7. [PHP Backend Logic](#php-backend-logic)
8. [Common Exam Questions & Answers](#common-exam-questions--answers)
9. [How to Add New Features](#how-to-add-new-features)

---

## Project Overview

### What is this project?
A **gym membership management website** for HTU (Hashemite University) Gym that allows:
- Users to browse classes and membership plans
- Users to sign up and login
- Users to manage their membership plans via a dashboard
- Admins to manage all database content

### Technologies Used
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Backend**: PHP 7+
- **Database**: MySQL
- **Hosting**: InfinityFree (Free hosting service)

### Key Features
1. **Public Pages**: Home, Classes, About, Community
2. **Authentication**: Login & Signup system
3. **User Dashboard**: View and manage personal plans
4. **Admin Panel**: Full CRUD operations on all tables
5. **Responsive Design**: Works on mobile and desktop

---

## File Structure

```
htu_gym-assignment/
├── html-pages/              # All HTML pages
│   ├── index.html          # Homepage
│   ├── classes.html        # Membership plans & classes
│   ├── about.html          # About gym, coaches, facilities
│   └── community.html      # Contact form & social links
│
├── php-pages/              # All PHP backend files
│   ├── login.php           # Login page + logic
│   ├── signup.php          # Registration page + logic
│   ├── dashboard.php       # User dashboard
│   ├── admin.php           # Admin panel
│   └── db.php              # Database connection test
│
├── css/                    # All stylesheets
│   ├── navbar.css          # Shared navbar styles
│   ├── footer.css          # Shared footer styles
│   ├── styles.css          # Homepage styles
│   ├── classes.css         # Classes page styles
│   ├── about.css           # About page styles
│   ├── community.css       # Community page styles
│   ├── login.css           # Login page styles
│   ├── signup.css          # Signup page styles
│   └── dashboard.css       # Dashboard styles
│
├── scripts/                # JavaScript files
│   └── script.js           # Form validation & plan selection
│
├── images/                 # All images
│   └── (various gym images)
│
└── db.sql                  # Database structure
```

### Why This Structure?
- **Separation of Concerns**: HTML, CSS, JS, and PHP are separated
- **Modularity**: Navbar and footer CSS are reusable across all pages
- **Maintainability**: Easy to find and update specific files
- **Scalability**: Easy to add new pages or features

---

## Database Architecture

### Database Name
`if0_40780923_htuGym`

### Connection Details
```php
$con = mysqli_connect(
    'sql203.infinityfree.com',  // Hostname
    'if0_40780923',              // Username
    'eXWsDBzMR5Nyd',            // Password
    'if0_40780923_htuGym',      // Database name
    3306                         // Port
);
```

### Tables Overview

#### 1. **users** - Stores user accounts
```sql
CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255) UNIQUE,
    password varchar(255)
);
```

**Purpose**: Store registered users  
**Key Fields**:
- `id`: Unique identifier (auto-increments)
- `email`: Must be unique (UNIQUE constraint)
- `password`: Plain text (not hashed for simplicity)

**Example Data**:
```sql
INSERT INTO users VALUES (1, 'John', 'Doe', 'john@example.com', 'password123');
```

---

#### 2. **plans** - Membership plans
```sql
CREATE TABLE plans(
    id int PRIMARY KEY AUTO_INCREMENT,
    plan_title varchar(255),
    plan_desc text,
    price float
);
```

**Purpose**: Store available membership plans  
**Key Fields**:
- `plan_title`: Name of plan (e.g., "Basic", "Elite")
- `plan_desc`: Description of what's included
- `price`: Monthly cost

**Example Data**:
```sql
INSERT INTO plans VALUES 
(1, 'Basic', '1 martial art - 2 sessions per week', 25.00),
(2, 'Elite', 'Unlimited classes', 60.00);
```

---

#### 3. **courses** - Specialist courses
```sql
CREATE TABLE courses(
    id int PRIMARY KEY AUTO_INCREMENT,
    course_title varchar(255),
    course_desc text,
    price float
);
```

**Purpose**: Store specialist training courses  
**Similar to plans** but for one-time or short-term courses

---

#### 4. **classes** - MMA classes schedule
```sql
CREATE TABLE classes(
    id int PRIMARY KEY AUTO_INCREMENT,
    class_title varchar(255),
    class_desc text
);
```

**Purpose**: Store information about available classes  
**Example**: "Brazilian Jiu-Jitsu", "Muay Thai"

---

#### 5. **coaches** - Gym coaches/trainers
```sql
CREATE TABLE coaches(
    id int PRIMARY KEY AUTO_INCREMENT,
    full_name varchar(255),
    coach_title text,
    coach_desc text
);
```

**Purpose**: Store coach information for About page  
**Key Fields**:
- `full_name`: Coach's name
- `coach_title`: Role (e.g., "Head Coach")
- `coach_desc`: Bio/description

---

#### 6. **user_plans** - Junction table (Many-to-Many)
```sql
CREATE TABLE user_plans(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int NOT NULL,
    plan_id int NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE
);
```

**Purpose**: Link users to their subscribed plans  
**Why Junction Table?**: One user can have multiple plans, one plan can belong to multiple users

**Foreign Keys**:
- `user_id` → `users.id`: If user deleted, their plans are deleted (CASCADE)
- `plan_id` → `plans.id`: If plan deleted, subscriptions are deleted (CASCADE)

**Example**:
```sql
-- User ID 1 subscribes to Plan ID 2
INSERT INTO user_plans (user_id, plan_id) VALUES (1, 2);
```

---

### Database Relationships

```
users (1) ----< user_plans >---- (M) plans
  |                                   |
  id                                  id
```

**Explanation**:
- One user can have many plans (1:M)
- One plan can belong to many users (M:1)
- Overall: Many-to-Many relationship via `user_plans`

---

## HTML Pages Explained

### 1. index.html - Homepage

**Purpose**: Landing page with hero section and gym introduction

**Key Sections**:
```html
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-black py-3">
    <!-- Logo, navigation links, login/signup buttons -->
</nav>

<!-- Hero Section -->
<div class="hero-section">
    <h1>UNLEASH YOUR <span>INNER WARRIOR</span></h1>
    <a href="classes.html" class="view-schedule">View Schedule</a>
</div>

<!-- Footer -->
<footer>
    <!-- Gym info and contact details -->
</footer>
```

**Bootstrap Classes Used**:
- `navbar navbar-expand-lg`: Responsive navbar
- `bg-black`: Black background
- `py-3`: Padding top/bottom (3 units)
- `container-fluid`: Full-width container
- `d-flex`: Display flex
- `gap-4`: Gap between elements (4 units)

**Custom Classes**:
- `.hero-section`: Full-screen hero with background image
- `.view-schedule`: Neon green button

---

### 2. classes.html - Membership Plans & Classes

**Purpose**: Display membership plans and class schedule

**Key Sections**:

#### Membership Plans Grid
```html
<div class="membership-plans">
    <div class="plan-card">
        <h3>Basic</h3>
        <h2>$25.00</h2>
        <ul>
            <li>1 martial art - 2 sessions per week</li>
            <li>Monthly fee</li>
        </ul>
        <button class="choose-plan" data-plan-id="1">Choose Plan</button>
    </div>
    <!-- More plan cards... -->
</div>
```

**Important Attributes**:
- `data-plan-id="1"`: Custom data attribute to identify which plan
- Used by JavaScript to add plan to user's dashboard

**CSS Layout**:
```css
.membership-plans {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}

.plan-card {
    width: calc(33.333% - 40px);  /* 3 cards per row */
    min-width: 280px;              /* Responsive minimum */
}
```

**Why `calc()`?**:
- `33.333%` = 1/3 of container width (3 columns)
- `- 40px` = Account for gap between cards
- `min-width: 280px` = On small screens, cards stack vertically

---

### 3. about.html - About Gym

**Purpose**: Show gym information, coaches, and facilities

**Key Sections**:

#### Who We Are (Flexbox Layout)
```html
<div class="who-we-are">
    <div class="who-text">
        <h2>WHO WE ARE</h2>
        <p>Description...</p>
    </div>
    <img src="../images/about-image.jpg" alt="Gym">
</div>
```

**CSS**:
```css
.who-we-are {
    display: flex;
    align-items: center;
    gap: 40px;
}

.who-text {
    flex: 1;  /* Take up available space */
}

.who-we-are img {
    width: 45%;
}
```

**Flexbox Explained**:
- `display: flex`: Items arranged horizontally
- `align-items: center`: Vertically center items
- `flex: 1`: Text takes remaining space
- `width: 45%`: Image takes 45% of container

---

#### Coaches Section (Flex-wrap)
```html
<div class="coaches-container">
    <div class="coach-card">
        <img src="../images/coach1.jpg">
        <h3>Coach Name</h3>
        <p>Title</p>
    </div>
    <!-- More coaches... -->
</div>
```

**CSS**:
```css
.coaches-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}

.coach-card {
    width: calc(33.333% - 20px);
    min-width: 250px;
}
```

**Why flex-wrap?**: Cards wrap to next line on smaller screens

---

#### Facilities Grid (CSS Grid)
```html
<div class="facilities-grid">
    <img src="../images/facility1.jpg" class="fac-img-1">
    <img src="../images/facility2.jpg" class="fac-img-2">
    <img src="../images/facility3.jpg" class="fac-img-3">
</div>
```

**CSS**:
```css
.facilities-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;  /* 2 columns */
    grid-template-rows: 1fr 1fr;     /* 2 rows */
    gap: 20px;
    height: 600px;
}

.fac-img-1 {
    grid-row: 1 / 2;     /* Row 1 */
    grid-column: 1 / 2;   /* Column 1 */
}

.fac-img-2 {
    grid-row: 2 / 3;     /* Row 2 */
    grid-column: 1 / 2;   /* Column 1 */
}

.fac-img-3 {
    grid-row: 1 / 3;     /* Spans both rows */
    grid-column: 2 / 3;   /* Column 2 */
}
```

**Grid Explained**:
- `1fr 1fr`: Two equal columns (fr = fraction)
- `grid-row: 1 / 3`: Start at row 1, end at row 3 (spans 2 rows)
- Creates asymmetric layout: 2 small images left, 1 large image right

---

### 4. community.html - Contact Form

**Purpose**: Contact form and social media links

**Key Sections**:

#### Contact Form
```html
<form class="contact-form">
    <div class="form-group">
        <label>First Name</label>
        <input type="text" placeholder="Enter your first name">
    </div>
    <!-- More fields... -->
    <button type="submit" class="submit-btn">Send Message</button>
</form>
```

**Form Validation**: Handled by JavaScript (see JavaScript section)

---

#### Social Media Links
```html
<div class="social-media-section">
    <h3>Follow Us On Our Socials</h3>
    <div class="social-links">
        <a href="instagram.com" class="social-link">Instagram</a>
        <a href="facebook.com" class="social-link">Facebook</a>
        <a href="linkedin.com" class="social-link">LinkedIn</a>
    </div>
</div>
```

**CSS**:
```css
.social-links {
    display: flex;
    justify-content: center;
    gap: 30px;
}

.social-link {
    color: white;
    transition: all 0.3s ease;
}

.social-link:hover {
    color: rgb(163, 230, 53);  /* Neon green */
    transform: translateY(-5px);  /* Move up slightly */
}
```

**CSS Transitions**:
- `transition: all 0.3s ease`: Smooth animation over 0.3 seconds
- `transform: translateY(-5px)`: Move element up 5 pixels on hover

---

## CSS Styling System

### Design Theme

**Colors**:
- **Primary Background**: `black` or `#1a1a1a` (dark gray)
- **Accent Color**: `rgb(163, 230, 53)` (neon green)
- **Text**: `white`
- **Secondary Background**: `#222` (medium gray)
- **Card Background**: `#1a1a1a`
- **Borders**: `#333`

**Typography**:
- **Font Family**: `sans-serif` (system default)
- **Headings**: Bold, large sizes (2rem - 3rem)
- **Body Text**: 1rem, line-height 1.6

---

### Modular CSS Architecture

#### navbar.css - Shared Navbar Styles
```css
.nav-item {
    color: #6c757d;  /* Gray */
    text-decoration: none;
    font-weight: bold;
    font-size: 0.9rem;
}

.nav-item:hover {
    color: rgb(163, 230, 53);  /* Neon green on hover */
}

.join-now {
    background-color: rgb(163, 230, 53);
    color: black;
    border-radius: 50px;  /* Fully rounded */
    padding: 10px 30px;
}
```

**Why Separate File?**: Navbar appears on all pages, so styles are reused

---

#### footer.css - Shared Footer Styles
```css
footer {
    background-color: #1a1a1a;
    color: white;
    padding: 60px 20px 30px;
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #333;
}

.footer-left-side h3 {
    color: rgb(163, 230, 53);
    margin-bottom: 20px;
}
```

**Flexbox in Footer**:
- `display: flex`: Arrange left and right sections horizontally
- `justify-content: space-between`: Push sections to opposite ends

---

### Page-Specific CSS

#### styles.css - Homepage
```css
.hero-section {
    background-image: url('../images/hero-bg.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;  /* Full viewport height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.hero-section h1 {
    font-size: 4rem;
    color: white;
    text-align: center;
}

.hero-section h1 span {
    color: rgb(163, 230, 53);  /* Highlight word */
}
```

**Background Image**:
- `background-size: cover`: Image covers entire area
- `background-position: center`: Center the image
- `height: 100vh`: Full screen height (viewport height)

---

#### classes.css - Membership Plans
```css
.membership-plans {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    padding: 60px 20px;
}

.plan-card {
    background-color: #1a1a1a;
    border-radius: 20px;
    padding: 40px;
    width: calc(33.333% - 40px);
    min-width: 280px;
    border: 1px solid #333;
    text-align: center;
}

.plan-card.best-plan {
    border: 2px solid rgb(163, 230, 53);  /* Highlight best plan */
}

.choose-plan {
    background-color: rgb(163, 230, 53);
    color: black;
    border: none;
    border-radius: 50px;
    padding: 15px 30px;
    font-weight: bold;
    cursor: pointer;
}

.choose-plan:hover {
    background-color: black;
    color: rgb(163, 230, 53);
    border: 2px solid rgb(163, 230, 53);
}
```

**Responsive Design**:
- Desktop (>900px): 3 cards per row (33.333%)
- Tablet (600-900px): 2 cards per row (auto-wrap)
- Mobile (<600px): 1 card per row (min-width: 280px)

---

#### dashboard.css - User Dashboard
```css
html {
    background-color: #222 !important;
}

body {
    background-color: #222 !important;
}
```

**Why `!important`?**: Override Bootstrap's default white background

```css
.plans-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}

.delete-btn {
    background-color: transparent;
    color: rgb(255, 50, 50);  /* Red */
    border: 2px solid rgb(255, 50, 50);
    border-radius: 50px;
}

.delete-btn:hover {
    background-color: rgb(255, 50, 50);
    color: black;
}
```

---

### CSS Best Practices Used

1. **Consistent Naming**: `.plan-card`, `.coach-card`, `.form-group`
2. **No Inline Styles**: All styles in CSS files (except Bootstrap utilities)
3. **Reusable Classes**: `.nav-item`, `.btn`, `.card`
4. **Responsive Units**: `rem`, `%`, `vh`, `calc()`
5. **Flexbox & Grid**: Modern layout techniques
6. **Transitions**: Smooth hover effects
7. **No Comments**: Clean production code

---

## JavaScript Functionality

### script.js - Complete Breakdown

#### 1. Form Validation

```javascript
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const fields = form.querySelectorAll('input, textarea');
            let hasEmptyField = false;

            fields.forEach(function (field) {
                if (field.value.trim() === '') {
                    hasEmptyField = true;
                }
            });

            if (hasEmptyField) {
                e.preventDefault();
                alert('Please Enter The Required feilds');
            }
        });
    });
});
```

**Explanation Line by Line**:

1. `document.addEventListener('DOMContentLoaded', ...)`:
   - Wait for HTML to fully load before running JavaScript
   - Ensures all form elements exist

2. `const forms = document.querySelectorAll('form')`:
   - Select ALL forms on the page
   - Returns a NodeList (array-like)

3. `forms.forEach(function (form) { ... })`:
   - Loop through each form
   - Add validation to each one

4. `form.addEventListener('submit', function (e) { ... })`:
   - Listen for form submission
   - `e` = event object

5. `const fields = form.querySelectorAll('input, textarea')`:
   - Get all input and textarea elements in THIS form

6. `if (field.value.trim() === '')`:
   - `field.value`: Get input value
   - `.trim()`: Remove whitespace
   - `=== ''`: Check if empty

7. `e.preventDefault()`:
   - Stop form from submitting
   - Prevents page reload

**Why This Approach?**:
- Works on ALL forms (login, signup, community)
- No need to duplicate code
- Client-side validation (fast feedback)

---

#### 2. Plan Selection (Choose Plan Buttons)

```javascript
const choosePlanButtons = document.querySelectorAll('.choose-plan');

choosePlanButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        const planId = this.getAttribute('data-plan-id');
        const userId = 1;
        window.location.href = '../php-pages/dashboard.php?action=add&plan_id=' + planId + '&user_id=' + userId;
    });
});
```

**Explanation**:

1. `document.querySelectorAll('.choose-plan')`:
   - Select all buttons with class `choose-plan`
   - Each button has `data-plan-id` attribute

2. `this.getAttribute('data-plan-id')`:
   - `this` = the clicked button
   - Get the plan ID (1, 2, 3, etc.)

3. `window.location.href = '...'`:
   - Redirect browser to new URL
   - Passes plan ID and user ID as URL parameters

4. **URL Structure**:
   ```
   dashboard.php?action=add&plan_id=2&user_id=1
   ```
   - `action=add`: Tell dashboard to add a plan
   - `plan_id=2`: Which plan to add
   - `user_id=1`: Which user (hardcoded for testing)

**Flow**:
1. User clicks "Choose Plan" on classes.html
2. JavaScript gets plan ID from button
3. Redirects to dashboard.php with parameters
4. PHP processes the request and adds plan to database

---

### JavaScript Concepts Used

1. **Event Listeners**: Respond to user actions (click, submit)
2. **DOM Manipulation**: Select and modify HTML elements
3. **Form Validation**: Check inputs before submission
4. **Data Attributes**: Store custom data in HTML (`data-*`)
5. **URL Parameters**: Pass data between pages

---

## PHP Backend Logic

### 1. Database Connection Pattern

**Used in ALL PHP files**:
```php
<?php
$con = mysqli_connect(
    'sql203.infinityfree.com',  // Hostname
    'if0_40780923',              // Username
    'eXWsDBzMR5Nyd',            // Password
    'if0_40780923_htuGym',      // Database
    3306                         // Port
);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

**Explanation**:
- `mysqli_connect()`: Create database connection
- `$con`: Connection object (used for all queries)
- `die()`: Stop script and show error if connection fails
- `mysqli_connect_error()`: Get error message

---

### 2. signup.php - User Registration

```php
<?php
$con = mysqli_connect('sql203.infinityfree.com', 'if0_40780923', 'eXWsDBzMR5Nyd', 'if0_40780923_htuGym', 3306);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO users (first_name, last_name, email, password) 
            VALUES ('$first_name', '$last_name', '$email', '$password')";
    
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Registration successful! Please login.'); 
              window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<!-- HTML form below -->
```

**Explanation**:

1. **Check Request Method**:
   ```php
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   ```
   - Only run if form was submitted
   - `$_SERVER['REQUEST_METHOD']`: GET or POST
   - POST = form submission

2. **Get Form Data**:
   ```php
   $first_name = $_POST['first_name'];
   ```
   - `$_POST`: Array of form data
   - `$_POST['first_name']`: Value from input with `name="first_name"`

3. **SQL INSERT Query**:
   ```php
   $sql = "INSERT INTO users (first_name, last_name, email, password) 
           VALUES ('$first_name', '$last_name', '$email', '$password')";
   ```
   - Insert new row into `users` table
   - Values come from form inputs

4. **Execute Query**:
   ```php
   if (mysqli_query($con, $sql))
   ```
   - `mysqli_query($con, $sql)`: Run the query
   - Returns `true` if successful, `false` if error

5. **JavaScript Alert & Redirect**:
   ```php
   echo "<script>alert('Registration successful!'); 
         window.location.href='login.php';</script>";
   ```
   - `echo "<script>..."`: Output JavaScript to browser
   - `alert()`: Show popup message
   - `window.location.href`: Redirect to login page

**Security Note**: This code is vulnerable to SQL injection (for learning purposes only)

---

### 3. login.php - User Authentication

```php
<?php
$con = mysqli_connect('sql203.infinityfree.com', 'if0_40780923', 'eXWsDBzMR5Nyd', 'if0_40780923_htuGym', 3306);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];
        echo "<script>alert('Login successful!'); 
              window.location.href='dashboard.php?user_id=$user_id';</script>";
    } else {
        echo "<script>alert('Invalid email or password!');</script>";
    }
}
?>
```

**Explanation**:

1. **SQL SELECT Query**:
   ```php
   $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
   ```
   - `SELECT *`: Get all columns
   - `WHERE email = '$email' AND password = '$password'`: Match both

2. **Execute & Get Results**:
   ```php
   $result = mysqli_query($con, $sql);
   ```
   - `$result`: Result set (rows that match)

3. **Check if User Found**:
   ```php
   if (mysqli_num_rows($result) == 1)
   ```
   - `mysqli_num_rows($result)`: Count matching rows
   - `== 1`: Exactly one user found (success)

4. **Get User Data**:
   ```php
   $user = mysqli_fetch_assoc($result);
   $user_id = $user['id'];
   ```
   - `mysqli_fetch_assoc()`: Convert result to associative array
   - `$user['id']`: Access the `id` column

5. **Redirect to Dashboard**:
   ```php
   window.location.href='dashboard.php?user_id=$user_id'
   ```
   - Pass user ID to dashboard via URL parameter

---

### 4. dashboard.php - User Dashboard

```php
<?php
$con = mysqli_connect('sql203.infinityfree.com', 'if0_40780923', 'eXWsDBzMR5Nyd', 'if0_40780923_htuGym', 3306);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 1;

// ADD PLAN
if ($action == 'add' && isset($_GET['plan_id'])) {
    $plan_id = $_GET['plan_id'];
    $sql = "INSERT INTO user_plans (user_id, plan_id) VALUES ($user_id, $plan_id)";
    
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Plan added successfully!'); 
              window.location.href='dashboard.php?user_id=$user_id';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

// DELETE PLAN
if ($action == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM user_plans WHERE id = $id";
    
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Plan removed successfully!'); 
              window.location.href='dashboard.php?user_id=$user_id';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

// GET USER'S PLANS
$sql = "SELECT user_plans.id as up_id, plans.* FROM plans 
        JOIN user_plans ON plans.id = user_plans.plan_id 
        WHERE user_plans.user_id = $user_id";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<body>
    <div class="plans-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="plan-card">';
                echo '<h3>' . $row['plan_title'] . '</h3>';
                echo '<h2>$' . $row['price'] . '</h2>';
                echo '<p>' . $row['plan_desc'] . '</p>';
                echo '<a href="dashboard.php?action=delete&id=' . $row['up_id'] . '&user_id=' . $user_id . '" class="delete-btn">Remove Plan</a>';
                echo '</div>';
            }
        } else {
            echo '<p class="no-plans">You have no plans yet. <a href="../html-pages/classes.html">Browse Plans</a></p>';
        }
        ?>
    </div>
</body>
</html>
```

**Explanation**:

1. **Get URL Parameters**:
   ```php
   $action = isset($_GET['action']) ? $_GET['action'] : '';
   ```
   - `isset($_GET['action'])`: Check if parameter exists
   - `? ... : ''`: Ternary operator (if true, use value, else use '')
   - `$_GET['action']`: Get value from URL (`?action=add`)

2. **Add Plan Logic**:
   ```php
   if ($action == 'add' && isset($_GET['plan_id']))
   ```
   - Check if action is "add" AND plan_id exists
   - Insert into `user_plans` table

3. **Delete Plan Logic**:
   ```php
   if ($action == 'delete' && isset($_GET['id']))
   ```
   - Check if action is "delete" AND id exists
   - Delete from `user_plans` table

4. **SQL JOIN Query**:
   ```php
   SELECT user_plans.id as up_id, plans.* FROM plans 
   JOIN user_plans ON plans.id = user_plans.plan_id 
   WHERE user_plans.user_id = $user_id
   ```
   - `JOIN`: Combine two tables
   - `ON plans.id = user_plans.plan_id`: Match condition
   - `WHERE user_plans.user_id = $user_id`: Filter by user
   - Gets all plans for this user

5. **Display Plans with PHP**:
   ```php
   while ($row = mysqli_fetch_assoc($result)) {
       echo '<div class="plan-card">';
       echo '<h3>' . $row['plan_title'] . '</h3>';
       // ...
   }
   ```
   - `while` loop: Iterate through all rows
   - `echo`: Output HTML
   - `$row['plan_title']`: Access column value
   - `.`: String concatenation

**URL Examples**:
- View dashboard: `dashboard.php?user_id=1`
- Add plan: `dashboard.php?action=add&plan_id=2&user_id=1`
- Delete plan: `dashboard.php?action=delete&id=5&user_id=1`

---

### 5. admin.php - Admin Panel

```php
<?php
$con = mysqli_connect('sql203.infinityfree.com', 'if0_40780923', 'eXWsDBzMR5Nyd', 'if0_40780923_htuGym', 3306);

session_start();

// LOGIN
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($email == 'admin@gmail.com' && $password == 'admin') {
        $_SESSION['admin'] = true;
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}

// LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit();
}

// ADD RECORD
if (isset($_POST['add'])) {
    $table = $_POST['table'];
    // Build INSERT query dynamically
    // ...
}

// DELETE RECORD
if (isset($_GET['delete'])) {
    $table = $_GET['table'];
    $id = $_GET['delete'];
    $sql = "DELETE FROM $table WHERE id = $id";
    mysqli_query($con, $sql);
}

$current_table = isset($_GET['table']) ? $_GET['table'] : 'users';
$result = mysqli_query($con, "SELECT * FROM $current_table");
?>

<!DOCTYPE html>
<html>
<?php if (!isset($_SESSION['admin'])): ?>
    <!-- Login Form -->
<?php else: ?>
    <!-- Admin Panel -->
    <div class="nav">
        <a href="?table=users">Users</a>
        <a href="?table=plans">Plans</a>
        <!-- More tables... -->
    </div>
    
    <!-- Add Form -->
    <form method="POST">
        <input type="hidden" name="table" value="<?php echo $current_table; ?>">
        <?php
        $columns = mysqli_query($con, "SHOW COLUMNS FROM $current_table");
        while ($col = mysqli_fetch_assoc($columns)) {
            if ($col['Field'] != 'id') {
                echo '<input type="text" name="' . $col['Field'] . '">';
            }
        }
        ?>
        <button type="submit" name="add">Add</button>
    </form>
    
    <!-- Data Table -->
    <table>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '<td><a href="?table=' . $current_table . '&delete=' . $row['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
<?php endif; ?>
</html>
```

**Explanation**:

1. **Sessions**:
   ```php
   session_start();
   $_SESSION['admin'] = true;
   ```
   - `session_start()`: Initialize session
   - `$_SESSION['admin']`: Store login state
   - Persists across page loads

2. **Hardcoded Admin Login**:
   ```php
   if ($email == 'admin@gmail.com' && $password == 'admin')
   ```
   - Simple check (no database lookup)
   - For learning purposes only

3. **Dynamic Table Selection**:
   ```php
   $current_table = isset($_GET['table']) ? $_GET['table'] : 'users';
   ```
   - Default to 'users' table
   - Change via URL: `?table=plans`

4. **Dynamic Form Generation**:
   ```php
   $columns = mysqli_query($con, "SHOW COLUMNS FROM $current_table");
   while ($col = mysqli_fetch_assoc($columns)) {
       echo '<input type="text" name="' . $col['Field'] . '">';
   }
   ```
   - `SHOW COLUMNS`: Get table structure
   - Create input for each column (except id)

5. **Conditional Rendering**:
   ```php
   <?php if (!isset($_SESSION['admin'])): ?>
       <!-- Show login -->
   <?php else: ?>
       <!-- Show admin panel -->
   <?php endif; ?>
   ```
   - Alternative PHP syntax for templates
   - `:` instead of `{`, `endif` instead of `}`

---

### PHP Concepts Used

1. **Variables**: `$con`, `$user_id`, `$sql`
2. **Arrays**: `$_POST`, `$_GET`, `$_SESSION`
3. **Conditionals**: `if`, `else`, ternary operator
4. **Loops**: `while`, `foreach`
5. **Functions**: `mysqli_connect()`, `mysqli_query()`, `isset()`
6. **String Concatenation**: `.` operator
7. **SQL Queries**: SELECT, INSERT, DELETE, JOIN
8. **Sessions**: `session_start()`, `$_SESSION`
9. **Redirects**: `header('Location: ...')`, `window.location.href`
10. **Error Handling**: `die()`, `mysqli_error()`

---

## Common Exam Questions & Answers

### HTML Questions

**Q1: What is the difference between `<div>` and `<span>`?**
- `<div>`: Block-level element (takes full width, starts new line)
- `<span>`: Inline element (only takes needed width, stays in line)

**Q2: Explain the navbar structure**
```html
<nav class="navbar navbar-expand-lg bg-black py-3">
    <div class="container-fluid px-4">
        <a class="navbar-brand">Logo</a>
        <button class="navbar-toggler">Menu</button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
```
- `navbar-expand-lg`: Collapse on small screens, expand on large
- `navbar-toggler`: Mobile menu button
- `collapse navbar-collapse`: Hidden on mobile, shown on desktop

**Q3: What is `data-plan-id` attribute?**
- Custom data attribute to store plan ID
- Accessed via JavaScript: `getAttribute('data-plan-id')`
- Used to identify which plan was clicked

---

### CSS Questions

**Q1: Explain Flexbox vs Grid**

**Flexbox** (1-dimensional):
```css
.container {
    display: flex;
    justify-content: center;  /* Horizontal alignment */
    align-items: center;      /* Vertical alignment */
    gap: 20px;                /* Space between items */
}
```
- Best for: Rows or columns
- Example: Navbar, card layouts

**Grid** (2-dimensional):
```css
.container {
    display: grid;
    grid-template-columns: 1fr 1fr;  /* 2 columns */
    grid-template-rows: 1fr 1fr;     /* 2 rows */
    gap: 20px;
}
```
- Best for: Complex layouts
- Example: Facilities grid (2 small, 1 large)

**Q2: What does `calc(33.333% - 40px)` do?**
- Calculate width: 33.333% of parent minus 40px
- Why? 3 cards per row (33.333% each) with 30px gap between
- `calc()` allows mixing units (% and px)

**Q3: Explain CSS specificity**
```css
/* Specificity: 1 (element) */
h1 { color: red; }

/* Specificity: 10 (class) */
.title { color: blue; }

/* Specificity: 100 (id) */
#main-title { color: green; }

/* Specificity: 1000 (inline) */
<h1 style="color: yellow;">

/* Override everything */
h1 { color: purple !important; }
```
- Higher specificity wins
- `!important` overrides all (use sparingly)

**Q4: What is the box model?**
```
┌─────────────────────────────┐
│        Margin               │
│  ┌──────────────────────┐   │
│  │     Border           │   │
│  │  ┌───────────────┐   │   │
│  │  │   Padding     │   │   │
│  │  │  ┌────────┐   │   │   │
│  │  │  │Content │   │   │   │
│  │  │  └────────┘   │   │   │
│  │  └───────────────┘   │   │
│  └──────────────────────┘   │
└─────────────────────────────┘
```
- Content: Actual content (text, images)
- Padding: Space inside border
- Border: Border around padding
- Margin: Space outside border

---

### JavaScript Questions

**Q1: What is `DOMContentLoaded`?**
```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Code runs after HTML is loaded
});
```
- Waits for HTML to fully load
- Ensures elements exist before accessing them
- Alternative: Put `<script>` at end of `<body>`

**Q2: Explain event delegation**
```javascript
// Bad: Add listener to each button
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', handleClick);
});

// Good: Add listener to parent
document.querySelector('.container').addEventListener('click', function(e) {
    if (e.target.classList.contains('btn')) {
        handleClick(e);
    }
});
```
- Attach listener to parent element
- Check which child was clicked
- More efficient for many elements

**Q3: What is `preventDefault()`?**
```javascript
form.addEventListener('submit', function(e) {
    e.preventDefault();  // Stop form submission
    // Validate first, then submit manually
});
```
- Stops default browser behavior
- For forms: Prevents page reload
- For links: Prevents navigation

---

### PHP Questions

**Q1: What is the difference between `$_GET` and `$_POST`?**

**`$_GET`**:
- Data in URL: `page.php?name=John&age=25`
- Visible to user
- Limited size (~2000 characters)
- Can be bookmarked
- Use for: Filtering, pagination, sharing links

**`$_POST`**:
- Data in request body (hidden)
- Not visible in URL
- No size limit
- Cannot be bookmarked
- Use for: Forms, sensitive data, file uploads

**Q2: Explain SQL JOIN**
```sql
-- INNER JOIN: Only matching rows
SELECT users.name, plans.title
FROM users
JOIN user_plans ON users.id = user_plans.user_id
JOIN plans ON plans.id = user_plans.plan_id;
```

**Result**:
```
name    | title
--------|--------
John    | Basic
John    | Elite
Sarah   | Advanced
```

**Q3: What is SQL injection?**
```php
// VULNERABLE CODE (our project)
$email = $_POST['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";

// If user enters: ' OR '1'='1
// Query becomes: SELECT * FROM users WHERE email = '' OR '1'='1'
// Returns ALL users!
```

**Prevention**:
```php
// Use prepared statements
$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
```

**Q4: Explain sessions**
```php
// Start session
session_start();

// Store data
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'john';

// Access data (on another page)
session_start();
echo $_SESSION['username'];  // john

// Destroy session (logout)
session_destroy();
```
- Stores data on server
- Persists across pages
- Identified by cookie (PHPSESSID)

---

### Database Questions

**Q1: What is a primary key?**
```sql
CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(255) UNIQUE
);
```
- Unique identifier for each row
- Cannot be NULL
- Cannot be duplicate
- `AUTO_INCREMENT`: Automatically increments (1, 2, 3...)

**Q2: What is a foreign key?**
```sql
CREATE TABLE user_plans(
    user_id int,
    plan_id int,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```
- Links to another table's primary key
- Enforces referential integrity
- `ON DELETE CASCADE`: Delete child rows when parent deleted

**Q3: What is normalization?**
**Bad (not normalized)**:
```
users table:
id | name  | plans
---|-------|------------------
1  | John  | Basic, Elite
2  | Sarah | Advanced
```

**Good (normalized)**:
```
users table:
id | name
---|------
1  | John
2  | Sarah

user_plans table:
user_id | plan_id
--------|--------
1       | 1
1       | 4
2       | 3
```
- Eliminates redundancy
- Easier to update
- Prevents anomalies

---

## How to Add New Features

### Example 1: Add a New Membership Plan

**Step 1: Add to Database**
```sql
INSERT INTO plans (plan_title, plan_desc, price) 
VALUES ('Premium', 'All classes + personal trainer', 80.00);
```

**Step 2: Add to classes.html**
```html
<div class="plan-card">
    <h3>Premium</h3>
    <h2>$80.00</h2>
    <ul>
        <li>All classes + personal trainer</li>
        <li>Monthly fee</li>
    </ul>
    <button class="choose-plan" data-plan-id="7">Choose Plan</button>
</div>
```

**Step 3: Test**
- Click "Choose Plan"
- Should add to dashboard
- Verify in database

---

### Example 2: Add Email Validation

**Step 1: Update JavaScript**
```javascript
form.addEventListener('submit', function(e) {
    const email = form.querySelector('input[type="email"]').value;
    
    // Email validation regex
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!emailPattern.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
        return;
    }
    
    // Continue with other validation...
});
```

**Regex Explained**:
- `^`: Start of string
- `[^\s@]+`: One or more characters (not space or @)
- `@`: Literal @ symbol
- `[^\s@]+`: One or more characters (not space or @)
- `\.`: Literal dot
- `[^\s@]+`: One or more characters (not space or @)
- `$`: End of string

---

### Example 3: Add Password Confirmation

**Step 1: Update signup.html**
```html
<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" id="password">
</div>

<div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password">
</div>
```

**Step 2: Update JavaScript**
```javascript
form.addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm_password').value;
    
    if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match!');
        return;
    }
});
```

**Step 3: Update signup.php**
```php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    
    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }
    
    // Continue with registration...
}
```

---

### Example 4: Add Search Functionality to Admin Panel

**Step 1: Add Search Form**
```html
<form method="GET">
    <input type="hidden" name="table" value="<?php echo $current_table; ?>">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit">Search</button>
</form>
```

**Step 2: Update PHP Query**
```php
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search != '') {
    $sql = "SELECT * FROM $current_table WHERE 
            CONCAT_WS(' ', *) LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM $current_table";
}

$result = mysqli_query($con, $sql);
```

**Explanation**:
- `CONCAT_WS(' ', *)`: Combine all columns with space
- `LIKE '%$search%'`: Match anywhere in text
- `%`: Wildcard (matches any characters)

---

### Example 5: Add Edit Functionality to Dashboard

**Step 1: Add Edit Button**
```php
echo '<a href="edit_plan.php?id=' . $row['up_id'] . '" class="edit-btn">Edit</a>';
```

**Step 2: Create edit_plan.php**
```php
<?php
$con = mysqli_connect(...);

$id = $_GET['id'];

// Get current data
$sql = "SELECT * FROM user_plans WHERE id = $id";
$result = mysqli_query($con, $sql);
$plan = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_plan_id = $_POST['plan_id'];
    $sql = "UPDATE user_plans SET plan_id = $new_plan_id WHERE id = $id";
    mysqli_query($con, $sql);
    header('Location: dashboard.php');
}
?>

<form method="POST">
    <select name="plan_id">
        <?php
        $plans = mysqli_query($con, "SELECT * FROM plans");
        while ($p = mysqli_fetch_assoc($plans)) {
            $selected = ($p['id'] == $plan['plan_id']) ? 'selected' : '';
            echo '<option value="' . $p['id'] . '" ' . $selected . '>' . $p['plan_title'] . '</option>';
        }
        ?>
    </select>
    <button type="submit">Update</button>
</form>
```

---

## Quick Reference

### Common MySQL Functions
```php
mysqli_connect()        // Connect to database
mysqli_query()          // Execute query
mysqli_fetch_assoc()    // Get row as array
mysqli_num_rows()       // Count rows
mysqli_error()          // Get error message
mysqli_close()          // Close connection
```

### Common PHP Functions
```php
isset()                 // Check if variable exists
empty()                 // Check if variable is empty
die()                   // Stop script
header()                // Send HTTP header (redirect)
session_start()         // Start session
session_destroy()       // End session
echo                    // Output text
print_r()               // Print array (debug)
var_dump()              // Print variable info (debug)
```

### Common JavaScript Methods
```javascript
document.querySelector()        // Select first element
document.querySelectorAll()     // Select all elements
addEventListener()              // Listen for event
getAttribute()                  // Get attribute value
setAttribute()                  // Set attribute value
preventDefault()                // Stop default action
window.location.href            // Redirect
alert()                         // Show alert
console.log()                   // Debug output
```

### Common CSS Properties
```css
display                 // How element is displayed
position                // Positioning method
flex                    // Flexbox properties
grid                    // Grid properties
background              // Background properties
color                   // Text color
font                    // Font properties
margin                  // Outside spacing
padding                 // Inside spacing
border                  // Border properties
width/height            // Dimensions
transition              // Animation
transform               // Transformations
```

---

## Final Tips for Oral Exam

### 1. Know Your Code
- Understand every line you wrote
- Be able to explain WHY you chose certain approaches
- Know the alternatives and trade-offs

### 2. Common Questions to Prepare
- "Explain how login works from start to finish"
- "What happens when user clicks 'Choose Plan'?"
- "How does the database structure support the features?"
- "What is the difference between Flexbox and Grid?"
- "How would you add [new feature]?"

### 3. Be Ready to Write Code
Practice writing:
- Simple SQL queries (SELECT, INSERT, UPDATE, DELETE)
- Form validation in JavaScript
- PHP database connection
- Basic CSS layouts

### 4. Understand the Flow
```
User Action → JavaScript → PHP → Database → PHP → Browser
```

Example: Adding a plan
1. User clicks "Choose Plan" (HTML button)
2. JavaScript gets plan ID and redirects
3. PHP receives request (dashboard.php?action=add&plan_id=2)
4. PHP inserts into database (user_plans table)
5. PHP redirects back to dashboard
6. Browser shows updated plans

### 5. Know the Terminology
- **Frontend**: HTML, CSS, JavaScript (what user sees)
- **Backend**: PHP, MySQL (server-side logic)
- **CRUD**: Create, Read, Update, Delete
- **MVC**: Model-View-Controller (design pattern)
- **API**: Application Programming Interface
- **Session**: Server-side storage for user data
- **Cookie**: Client-side storage

---

## Good Luck! 🎓

Remember:
- Understand concepts, don't just memorize
- Practice explaining out loud
- Draw diagrams if helpful
- Ask for clarification if needed
- Stay calm and confident

You built this entire project - you know it better than anyone! 💪
