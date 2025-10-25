# GameVault

**GameVault** is a Laravel web application where users can explore, review, and manage their personal video game collection.  
It includes authentication, role-based access control (admin & user), and a review system with deeper validation logic — built entirely in **Laravel + Breeze (Blade)**.

---

## Features

- **Authentication & Security** — Laravel Breeze with registration, login, password reset, and CSRF protection  
- **User Roles** — Admin and regular user roles with separated access levels  
- **Role-based Access Control** — Admin-only dashboard and management routes  
- **Search & Filter** — Games can be searched by title and filtered by genre or platform  
- **Reviews System** — Users can review games only after specific conditions are met (custom validation rule)  
- **Status Toggles** — Admin can activate/deactivate or feature games via POST actions  
- **OWASP Compliance** — Secure handling of forms, input validation, password hashing, and no raw SQL  
- **SQLite Database** — Lightweight setup for local development and assessment environments  

---

## Tech Stack

| Component | Technology |
|------------|-------------|
| **Framework** | [Laravel 11](https://laravel.com/) |
| **Frontend** | Blade (Laravel Breeze) |
| **Database** | SQLite |
| **Authentication** | Laravel Breeze (built-in Auth) |
| **Testing** | Pest PHP |
| **Styling** | Tailwind CSS |
| **Version Control** | Git + GitHub |

---

## Local Setup

Clone this repository and follow the steps below to run GameVault locally:

```bash
# 1. Clone repository
git clone https://github.com/<your-username>/gamevault.git
cd gamevault

# 2. Install PHP dependencies
composer install

# 3. Copy the environment file
cp .env.example .env

# 4. Generate an app key
php artisan key:generate

# 5. Create a SQLite database
touch database/database.sqlite
php artisan migrate

# 6. Install frontend dependencies
npm install && npm run build

# 7. Start the development server
php artisan serve

