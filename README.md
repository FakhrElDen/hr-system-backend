HR System – Laravel API & Vue Frontend
This project is a simple HR management system built with Laravel (backend) and Vue 3 (frontend).
It handles CRUD operations for employees with filtering, search, and authentication using Sanctum.

Features
Employee CRUD – Create, Read, Update, Delete employees.
Filtering & Search – Filter by name, status, and hired date.
Image Uploads – Employee photo uploads handled by Spatie Media Library.
Excel Export – Export all employees to an Excel sheet using Laravel Excel.
Authentication – API authentication with Laravel Sanctum.
Seeders – Run provided seeders for test data and authentication users.

Setup Instructions
Backend (Laravel)
Install dependencies:

composer install
Set up your .env file with your database and Sanctum configuration.

Run migrations and seeders:

php artisan migrate --seed
UserSeeder creates a default user for authentication.

EmployeeSeeder creates sample employees for testing.

Link storage for uploaded images:

php artisan storage:link
CORS Configuration:
In config/cors.php, update allowed_origins to include your frontend port. For example:

'allowed_origins' => ['http://localhost:5173'],
Serve the API:

php artisan serve
Frontend (Vue 3)
Install dependencies:

npm install
Run the development server:

npm run dev
Make sure the port matches what you added in cors.php (default is 5173).

Notes
Images: Employee photos are stored and managed using Spatie Media Library.

Excel Export: Use the provided /employees/export route to download an Excel sheet.

Authentication: Sanctum is used for login and token-based access.

Login via /auth/login and store the returned token in local storage.

All protected routes require the Authorization: Bearer <token> header.

Seeder Information
Run seeders to create test data:

php artisan db:seed --class=UserSeeder
php artisan db:seed --class=EmployeeSeeder
Use the seeded user credentials to log in from the frontend.

Test employees will appear in the listing with search & filtering.
