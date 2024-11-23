# Project **Quickway Task** Setup Guide

This guide provides step-by-step instructions to set up and run this project, which includes:

- Laravel Breeze for authentication.
- React integrated via CDN.
- Livewire for dynamic components.

---

## Prerequisites

Make sure you have the following installed on your system:

- **PHP >= 8.1**
- **Laravel = 10.0**
- **Composer**
- **Node.js and npm**
- **MySQL or other supported database**

---

## Installation and Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd <project-directory>
```

### 2. Install Laravel Dependencies 
Install the required PHP dependencies using Composer:
```bash
composer install
```


### 3. Create .env File
Copy the example .env file and configure it:
```bash
cp .env.example .env
```
Update the .env file with your database details:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your-database-name>
DB_USERNAME=<your-database-username>
DB_PASSWORD=<your-database-password>
```
### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Database Migrations
Set up the database schema by running migrations:
```bash
php artisan migrate
```


## Database Seeding

### Run the Admin & Task Seeder

```bash
php artisan db:seed --class=AdminSeeder

php artisan db:seed --class=TaskSeeder
```

## Publish Livewire Assets (optional if livewire not work)
```bash
php artisan livewire:publish
```

## Run Server
```bash
php artisan serve
```

## Admin Login By Admin Seeder
- **User : admin@gmail.com**
- **Password : 12345678**

## For Other User Login 
- **User : example@mail.com**
- **Password : password**

Use User mail ID and password are **'password'** for all seeder users.