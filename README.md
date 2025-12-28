# HTU GYM Website 🥋

A modern, full-stack gym membership management website built for Hashemite Technical University's gym. Features user authentication, membership plan management, and a comprehensive admin panel.

[![Live Demo](https://img.shields.io/badge/demo-live-brightgreen)](https://your-infinityfree-url.com)
[![PHP](https://img.shields.io/badge/PHP-7%2B-blue)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)](https://getbootstrap.com)

## 🌟 Features

### Public Pages
- **Homepage**: Eye-catching hero section with gym introduction
- **Classes**: Browse membership plans and class schedules
- **About**: Learn about coaches, facilities, and gym philosophy
- **Community**: Contact form and social media links

### User Features
- **Sign Up & Login**: Secure user authentication system
- **Personal Dashboard**: View and manage membership plans
- **Plan Selection**: Add/remove plans with one click
- **Responsive Design**: Works seamlessly on all devices

### Admin Features
- **Admin Panel**: Full CRUD operations on all database tables
- **User Management**: View and manage registered users
- **Content Management**: Update plans, courses, classes, and coaches
- **Secure Access**: Protected admin login (admin@gmail.com / admin)

## 🛠️ Technologies Used

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Custom styling with Flexbox & Grid
- **JavaScript** - Form validation and interactivity
- **Bootstrap 5** - Responsive framework

### Backend
- **PHP 7+** - Server-side logic
- **MySQL** - Database management
- **mysqli** - Database connectivity

### Hosting
- **InfinityFree** - Free web hosting
- **phpMyAdmin** - Database administration

## 📂 Project Structure

```
htu_gym-assignment/
├── html-pages/              # Public HTML pages
│   ├── index.html          # Homepage
│   ├── classes.html        # Membership plans
│   ├── about.html          # About page
│   └── community.html      # Contact page
│
├── php-pages/              # PHP backend files
│   ├── login.php           # User login
│   ├── signup.php          # User registration
│   ├── dashboard.php       # User dashboard
│   ├── admin.php           # Admin panel
│   └── db.php              # Database connection test
│
├── css/                    # Stylesheets
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
├── images/                 # Image assets
│
├── db.sql                  # Database schema
└── README.md               # This file
```

## 🗄️ Database Schema

### Tables

**users** - Registered users
```sql
id, first_name, last_name, email, password
```

**plans** - Membership plans
```sql
id, plan_title, plan_desc, price
```

**courses** - Specialist courses
```sql
id, course_title, course_desc, price
```

**classes** - MMA classes
```sql
id, class_title, class_desc
```

**coaches** - Gym coaches
```sql
id, full_name, coach_title, coach_desc
```

**user_plans** - User-Plan junction table
```sql
id, user_id, plan_id, subscribed_at
```

### Relationships
- Users ↔ Plans: Many-to-Many (via user_plans)
- Foreign keys with CASCADE delete

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.0 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or XAMPP

### Local Development

1. **Clone the repository**
```bash
git clone https://github.com/ICEQ-JO/htu-gym-website.git
cd htu-gym-website
```

2. **Set up database**
```bash
# Create database
mysql -u root -p
CREATE DATABASE htuGym;
exit;

# Import schema
mysql -u root -p htuGym < db.sql
```

3. **Insert sample data**
```sql
INSERT INTO plans (plan_title, plan_desc, price) VALUES
('Basic', '1 martial art - 2 sessions per week - Monthly fee', 25.00),
('Intermediate', '1 martial art - 3 sessions per week - Monthly fee', 35.00),
('Advanced', 'Any 2 martial arts - 5 sessions per week - Monthly fee', 45.00),
('Elite', 'Unlimited classes - Monthly fee', 60.00),
('Junior Membership', 'Can attend all-kids martial arts sessions - Monthly fee', 25.00),
('Private Martial Arts Tuition', 'Per hour', 15.00);
```

4. **Update database credentials**

Edit all PHP files in `php-pages/` and update connection details:
```php
$con = mysqli_connect(
    'localhost',    // Hostname
    'root',         // Username
    '',             // Password
    'htuGym',       // Database name
    3306            // Port
);
```

5. **Start local server**
```bash
# Using PHP built-in server
php -S localhost:8000

# Or use XAMPP
# Place files in htdocs/ and access via http://localhost/htu_gym-assignment
```

6. **Access the website**
```
Homepage: http://localhost:8000/html-pages/index.html
Login: http://localhost:8000/php-pages/login.php
Admin: http://localhost:8000/php-pages/admin.php
```

### Production Deployment (InfinityFree)

1. **Upload files via FTP**
   - Upload all files to `htdocs/` directory
   - Move `index.html` to root if needed

2. **Create database**
   - Go to MySQL Databases in control panel
   - Create database: `if0_40780923_htuGym`

3. **Import schema**
   - Open phpMyAdmin
   - Import `db.sql`
   - Insert sample plan data

4. **Update credentials**
   - Already configured for InfinityFree
   - Hostname: `sql203.infinityfree.com`
   - Database: `if0_40780923_htuGym`

## 🎨 Design System

### Color Palette
- **Primary Background**: `#000000` (Black)
- **Secondary Background**: `#1a1a1a` (Dark Gray)
- **Accent Color**: `rgb(163, 230, 53)` (Neon Green)
- **Text**: `#FFFFFF` (White)
- **Borders**: `#333333`

### Typography
- **Font Family**: System sans-serif
- **Headings**: 2rem - 4rem, Bold
- **Body**: 1rem, Regular

### Layout
- **Flexbox**: Used for navigation, cards, and responsive layouts
- **CSS Grid**: Used for asymmetric layouts (facilities section)
- **Responsive**: Mobile-first approach with Bootstrap breakpoints

## 📱 Responsive Breakpoints

- **Mobile**: < 576px (1 column)
- **Tablet**: 576px - 992px (2 columns)
- **Desktop**: > 992px (3 columns)

## 🔐 Default Credentials

### Admin Access
```
Email: admin@gmail.com
Password: admin
```

### Test User (Create via signup)
```
Use signup page to create your own account
```

## 🎯 Key Features Explained

### 1. User Authentication
- PHP session-based login system
- Password stored in plain text (educational project)
- Redirect to dashboard after successful login

### 2. Dashboard System
- View subscribed plans
- Add plans via "Choose Plan" button
- Remove plans with one click
- Real-time database updates

### 3. Admin Panel
- Dynamic table switching (Users, Plans, Courses, etc.)
- Add new records via auto-generated forms
- Delete records with confirmation
- Simple session-based authentication

### 4. Form Validation
- JavaScript client-side validation
- Checks for empty fields
- Prevents form submission if invalid
- User-friendly error messages

## 🧪 Testing

### Manual Testing Checklist

**Public Pages**
- [ ] Homepage loads correctly
- [ ] Navigation works on all pages
- [ ] Images display properly
- [ ] Forms are accessible

**User Flow**
- [ ] Sign up creates new user
- [ ] Login redirects to dashboard
- [ ] Choose Plan adds to dashboard
- [ ] Remove Plan deletes from dashboard

**Admin Panel**
- [ ] Admin login works
- [ ] Can view all tables
- [ ] Can add records
- [ ] Can delete records

## 📝 Known Limitations

- **No password hashing**: Passwords stored in plain text (educational project)
- **No SQL injection protection**: Uses basic queries (not production-ready)
- **No email verification**: Users can sign up without verification
- **Hardcoded user ID**: Dashboard uses URL parameter for user identification
- **No session timeout**: Sessions persist until browser close

## 🔮 Future Enhancements

- [ ] Password hashing (bcrypt)
- [ ] Prepared statements for SQL injection protection
- [ ] Email verification system
- [ ] Session-based user tracking
- [ ] Password reset functionality
- [ ] User profile editing
- [ ] Payment integration
- [ ] Class booking system
- [ ] Coach availability calendar
- [ ] Member reviews and ratings


## 👨‍💻 Author

**Khaled Khudari**
- GitHub: [@ICEQ-JO](https://github.com/ICEQ-JO)
- Email: khaledkhudari1@gmail.com
- University : Al Hussain Technical University


**Built with ❤️ By Khalid Khudari for HTU GYM**


