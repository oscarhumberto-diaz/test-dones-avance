# AVANCE Spiritual Gifts Test (Laravel)

## 1. Project Title
**AVANCE Spiritual Gifts Test (AVANCE 2020)**

## 2. Description
This repository contains a Laravel web application for the **AVANCE 2020 Spiritual Gifts Test** used in a church discipleship context.

The application stores a 60-question assessment, lets participants answer the questionnaire in the web flow, and supports calculating spiritual gift tendencies from recorded answers.

## 3. Features
- Laravel-based web app with a guided test flow (`/test`) and results endpoint (`/resultado/{attempt}`).
- Admin panel with authentication at `/admin` (login, dashboard, history filters, and password change).
- Database schema for tests, questions, gifts, attempts, answers, and aggregated scores.
- Seeder for the AVANCE 2020 test structure and admin user provisioning.
- Artisan command to import/update question text from JSON:
  - `php artisan avance:import-preguntas {path}`
- Included dataset with 60 questions:
  - `storage/app/preguntas-avance-2020.json`

## 4. Technology Stack
- **Backend:** PHP 8.2+, Laravel 12, Livewire 3
- **Database:** MariaDB/MySQL
- **Frontend build tools:** Node.js, npm, Vite, Tailwind CSS, DaisyUI

## 5. Installation Instructions
Clone the repository and install PHP/Node dependencies:

```bash
git clone https://github.com/<your-org>/test-dones-avance.git
cd test-dones-avance
composer install
npm install
```

Generate a production build for frontend assets:

```bash
npm run build
```

## 6. Environment Configuration
Create your local environment file and application key:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and configure database credentials (MariaDB or MySQL), for example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_dones_avance
DB_USERNAME=your_user
DB_PASSWORD=your_password

# Admin bootstrap credentials (installation-time only)
ADMIN_USER=oscard
ADMIN_PASSWORD=Oscar121*
```

## 7. Database Setup
Run migrations and seed base records + initial admin user:

```bash
php artisan migrate --seed
```

If you prefer, you can run only migrations first:

```bash
php artisan migrate
```

Create/update only the admin user manually:

```bash
php artisan db:seed --class=AdminUserSeeder
```

> The admin password is always saved hashed (bcrypt via `Hash::make`), never in plain text.

## 8. Admin Access
- Open `/admin/login` and sign in with the admin credentials.
- Routes under `/admin/*` are protected by `auth` middleware.
- There is no public registration endpoint.
- Change password at `/admin/perfil/password` once logged in.

## 9. Importing the 60 Questions (Artisan Command)
Use the included dataset to update the `questions` table:

```bash
php artisan avance:import-preguntas storage/app/preguntas-avance-2020.json
```

Expected JSON format:

```json
[
  { "numero": 1, "texto": "..." },
  { "numero": 2, "texto": "..." }
]
```

## 10. Running the Development Server
Start Laravel and Vite in separate terminals:

```bash
php artisan serve
npm run dev
```

Then open the app in your browser at the URL shown by `php artisan serve` (commonly `http://127.0.0.1:8000`).

## 11. Project Structure Overview

```text
app/
  Console/Commands/        # Custom artisan commands (including question import)
  Http/Controllers/        # Public and admin HTTP controllers
  Models/                  # Domain entities and User model
config/
  auth.php                 # Session guard + user provider configuration
database/
  migrations/              # Schema for tests, questions, attempts, users, and sessions
  seeders/                 # AVANCE 2020 base data + AdminUserSeeder
resources/
  views/                   # Blade templates for test, result pages, and admin UI
routes/
  web.php                  # Public and admin routes
storage/app/
  preguntas-avance-2020.json  # 60-question dataset
```

## 12. License
This project is licensed under the **MIT License**.
