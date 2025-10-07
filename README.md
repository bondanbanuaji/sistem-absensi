# Sistem-Absensi

**A simple school attendance system** built with **Laravel 12**. Supports **role-based dashboards** for admin, teacher, and student, with attendance tracking and charts.

---

## ✨ Features

- **Role-based authentication** and dashboards:
  - **Admin**: Manage students, manage attendances, view charts
  - **Teacher**: View and manage attendances  
  - **Student**: View personal attendance
- **Students CRUD** (admin)
- **Attendances CRUD** with date filter and search
- **Simple charts** using **Chart.js**
- Authentication scaffolded with **Laravel Breeze**

---

## 🛠 Tech Stack / Requirements

- **PHP 8.2+**
- **Laravel 12.x**
- **MySQL / MariaDB**
- **Node.js + npm** (for frontend assets via Vite)
- **Composer**

---

## 🚀 Quick Setup

1. **Clone the repo:**
```bash
git clone git@github.com:bondanbanuajj/sistem-absensi.git
cd sistem-absensi
```

2. **Copy .env.example to .env and set DB credentials:**
```bash
cp .env.example .env
```

3. **Install dependencies:**
```bash
composer install
npm install
npm run build
php artisan key:generate
```

4. **Migrate & seed database:**
```bash
php artisan migrate --seed
```

5. **Serve project:**
```bash
php artisan serve
# visit http://127.0.0.1:8000
```

---

## 👥 Roles & Usage

### **Admin**
- Manage students and attendances
- View attendance charts

### **Teacher** 
- Manage attendance records
- Filter and search students

### **Student**
- View personal attendance

---

## 📝 Notes

- Role-specific routes are protected by middleware
- Students cannot access admin or teacher routes
- Use `php artisan route:list` to see all routes
- Clear cache if needed:
```bash
php artisan config:clear
php artisan route:clear  
php artisan view:clear
php artisan cache:clear
```

---

## 📄 License

**MIT License**
