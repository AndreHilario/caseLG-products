# LG Product Management SPA

## Overview

This project is a **Single Page Application (SPA)** for managing LG product registrations. It allows you to create, edit, and delete products with categorization.

Built with:

- **Backend:** Laravel 6.2 (PHP Framework)
- **Frontend:** Vue.js

The app provides a smooth product management experience by combining Laravel’s powerful backend with Vue’s reactive frontend.

---

## Installation and Setup

### Prerequisites

Make sure you have installed:

- PHP >= 7.2.5
- Composer
- Node.js & npm or Yarn
- A database server (MySQL, PostgreSQL, etc.)

### Steps to Run Locally

1. Clone the repository:

```bash
git clone <repository-url>
cd <project-folder>
```

2. Install backend dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Setup environment file:

```bash
cp .env.example .env
```

5. Configure .env with your database credentials.

6. Generate the application key:

```bash
php artisan key:generate
```

## Database Setup

### Run Migrations
- Run the migrations to create the necessary tables:

```bash
php artisan migrate
```

### Seed the Database
- To populate the database with initial data:

```bash
php artisan db:seed
```

## Running the Application
### Backend Server

To serve the Laravel backend:

```bash
php artisan serve
```

The backend will be available at: http://localhost:8000

### Frontend Server
To run Vue.js in development:

```bash
npm run dev
```

### Or watch for changes:

```bash
npm run watch
```

# Features
✅ Register new products with name, category, and price

📝 Edit and delete products easily

📦 Categorization system

⚡ Responsive SPA built with Vue.js

🔔 Toast notifications for success/error

💾 Laravel API-based backend

# Technologies Used
- Laravel 6.2 – Routing, migrations, seeding, API

- Vue.js – SPA frontend

- Axios – HTTP requests from Vue to Laravel

- Vue Toastification – Toast alert system

- SASS – For styled components and UI

## Troubleshooting

- Run php artisan config:clear, cache:clear, or route:clear if you face cache-related issues.

- Ensure seeders and namespaces match if using DatabaseSeeder.

# License
- This project is licensed under the MIT License.
