# Staff Attendance & Leave System

A Laravel-based employee attendance and leave management system developed for **Justice & Co. Law Associates**.

## Features

### Employee Management
- Add, view, edit and delete employees.
- Employee data validation.
- Department assignment.

### Attendance Management
- Daily employee check-in and check-out.
- Prevent duplicate check-ins and check-outs.
- Prevent check-out before check-in.
- Monthly attendance CSV export.
- Export attendance records by selected month.

### Leave Management
- Submit leave requests.
- Validate leave dates and reasons.
- Approve or reject leave requests.
- View employee leave history.

## Technologies

- PHP 8.2+
- Laravel 12
- MySQL / PostgreSQL / SQLite
- Blade Templates
- Bootstrap
- JavaScript
- Vite
- Git and GitHub

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Sameer-dev-0099/justice-attendance.git
   cd justice-attendance
   ```

2. Install dependencies:

   ```bash
   composer install
   npm ci
   ```

3. Create the environment file:

   ```bash
   cp .env.example .env
   ```

   On Windows PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Configure your database credentials in `.env`.

6. Run migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

7. Build frontend assets:

   ```bash
   npm run build
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

9. Open `http://127.0.0.1:8000`.

## Monthly Attendance CSV Export

Use the following URL:

```text
/attendance/export?month=2026-11
```

Change the month parameter to export attendance records for another month.

## Testing

Run the test suite:

```bash
php artisan test
```

## Deployment

Docker configuration is included for deployment on a Docker-compatible hosting platform.

Configure production environment variables through your hosting provider. Never commit `.env` or database credentials to GitHub.

## Developer

Sameer Razzaq