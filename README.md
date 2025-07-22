# 🚀 HR System – Laravel API & Vue Frontend

This project is a simple **HR management system** built with **Laravel** (backend) and **Vue 3** (frontend).  
It handles **CRUD operations for employees**, with filtering, search, image uploads, Excel export, and authentication using **Laravel Sanctum**.

---

## ✨ Features

✅ **Employee CRUD** – Create, Read, Update, and Delete employees  
✅ **Filtering & Search** – Filter by name, status, and hired date  
✅ **Image Uploads** – Employee photo uploads handled by [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary)  
✅ **Excel Export** – Export employees to Excel using [Laravel Excel](https://laravel-excel.com/)  
✅ **Authentication** – API authentication with Laravel Sanctum  
✅ **Seeders** – Preloaded seeders for test data and authentication users  

---

## ⚙️ Setup Instructions

### 🔧 Backend (Laravel)

1️⃣ **Install dependencies**  
```bash
composer install
```

2️⃣ **Configure environment**  
Copy `.env.example` to `.env` and update:
- Database credentials
- Sanctum configuration

3️⃣ **Run migrations & seeders**  
```bash
php artisan migrate --seed
```
- **UserSeeder**: Creates a default user for authentication  
- **EmployeeSeeder**: Creates sample employees for testing

4️⃣ **Link storage for uploaded images**  
```bash
php artisan storage:link
```

5️⃣ **Configure CORS**  
Open `config/cors.php` and update `allowed_origins` to include your frontend port:
```php
'allowed_origins' => ['http://localhost:5173'],
```

6️⃣ **Serve the API**  
```bash
php artisan serve
```

---

### 🌐 Frontend (Vue 3)

1️⃣ **Install dependencies**  
```bash
npm install
```

2️⃣ **Run development server**  
```bash
npm run dev
```

✅ Ensure the port matches what you added in `config/cors.php` (default: **5173**).

---

## 📌 Notes

📷 **Images**  
Employee photos are stored and managed using **Spatie Media Library**.

📊 **Excel Export**  
Use the provided route to download an Excel sheet:  
`GET /employees/export`

🔑 **Authentication**  
Sanctum is used for login and token-based access.  
- Login: `POST /auth/login`  
- Store the returned token in local storage.  
- All protected routes require the header:  
`Authorization: Bearer <token>`

---

## 🌱 Seeder Information

Run the following seeders to create test data:
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=EmployeeSeeder
```

✅ Use the seeded user credentials to log in from the frontend.  
✅ Test employees will appear in the listing with search & filtering enabled.
