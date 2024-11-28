# Tenjaz Project

A Laravel-based API that provides user and product resources, with dynamic product pricing based on the user's subscription type.

---

## Features

### 1. User Resource
- Manages users with different subscription types.
- Each user is assigned a subscription type (`normal`, `gold`, or `silver`).

### 2. Product Resource
- Provides CRUD functionality for products.
- Includes dynamic pricing based on the user’s subscription type.

### 3. Dynamic Product Pricing
- Prices are adjusted based on the user's subscription type:
    - **Normal Users**: No discount.
    - **Silver Users**: 10% discount.
    - **Gold Users**: 20% discount.

---

## Installation Guide

### Prerequisites
- **PHP >= 8.1**
- **Composer**
- **MySQL (or compatible database)**

### Step 1: Clone the Repository
```bash
git clone https://github.com/MohamedAlaa2104/tenjaz.git
cd tenjaz
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Configure the Application
- Copy the example .env file:
```bash
cp .env.example .env
```

- Set your database connection in the .env file:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Run Migrations and Seeders
```bash
php artisan migrate --seed
```
This will create the database tables and seed the application with default data, including:
- 3 users (one for each subscription type: normal, silver, gold).
- 100 products.

Default Users:

|              Name               |    Username    |           Email           | Subscription Type |
|:-------------------------------:|----------------|:-------------------------:|:-----------------:|
|           Normal User           |   normaluser   |    normal@example.com     |      Normal       |
|           Silver User           |   silveruser   |    silver@example.com     |      Silver       |
|            Gold User            |    golduser    |     gold@example.com      |       Gold        |


Password for all users: password

### Usage
#### Starting the Development Server

Run the development server:

```bash
php artisan serve
```

### API Endpoints
#### User Resource

    GET /api/v1/users - List all users.
    GET /api/v1/users/{id} - Retrieve a specific user.
    POST /api/v1/users - Create a new user.
    PUT /api/v1/users/{id} - Update a user.
    DELETE /api/v1/users/{id} - Delete a user.

#### Product Resource

    GET /api/v1/products - List all products.
    GET /api/v1/products/{id} - Retrieve a specific product with pricing based on the authenticated user's subscription type.
    POST /api/v1/products - Create a new product.
    PUT /api/v1/products/{id} - Update a product.
    DELETE /api/v1/products/{id} - Delete a product.

### Seeder Details

#### The DatabaseSeeder creates:

1- Three subscription types:
- Normal (0% discount)
- Silver (10% discount)
- Gold (20% discount)

2- Three default users, each linked to a subscription type.

3- 100 products with randomized details.

