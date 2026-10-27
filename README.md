# Staff Attendance & Leave System

A Laravel-based employee management project for **Justice & Co. Law Associates**.

## Task 1 Features

- Department database table and migration.
- Employee database table and migration.
- Seeder creates 3 departments and 5 employees.
- Employees page at `/employees`.
- Employee table displays employee names and their departments.

## Technologies

- PHP
- Laravel
- MySQL / compatible configured database
- Blade Templates
- Git and GitHub

## Installation

1. Clone or download this repository.
2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Create your environment file:

   ```bash
   copy .env.example .env
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

7. Start the local server:

   ```bash
   php artisan serve
   ```

8. Open `http://127.0.0.1:8000/employees`.

## Database Setup

The project includes department and employee migrations, along with seed data for three departments and five employees.

## Current Scope

This task focuses on database setup, sample data, and displaying employees with their departments. Full attendance tracking and leave management are not included in this initial task.

## Developer

Sameer Razzaq