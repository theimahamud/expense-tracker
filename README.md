# Expense Tracker with Monthly Report

## Overview

This is a simple Expense Tracker application built with Laravel.\
It allows users to track daily expenses, view them in a list, and see
monthly reports grouped by category.

## Features

-   User authentication (only logged-in users can access the system)
-   Add daily expenses (fields: title, amount, date, category)
-   Fixed categories (Food, Transport, Shopping, Others) stored in DB
    and selectable via dropdown
-   View expense list (latest first)
-   Monthly report page showing total expenses grouped by category
-   Bonus: Monthly expense visualization chart using **Chart.js**

## Example Report

    Transport: 1200
    Food : 2500
    Shopping: 800
    Others: 600
    ----------------
    Total: 5100

## Installation

1.  Clone the repository:

    ```bash
    git clone https://github.com/theimahamud/expense-tracker.git
    cd expense-tracker
    ```

2.  Install dependencies:

    ```bash
    composer install
    npm install && npm run dev
    ```

3.  Setup environment file:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  Configure your database in `.env` file.

5.  Run migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

    (Seeder includes a default **admin user** for login)

6.  Start the server:

    ```bash
    php artisan serve
    ```

7.  Visit `http://127.0.0.1:8000` in your browser.

## Default Admin User

-   **Email:** admin@gmail.com
-   **Password:** password

## Technologies Used

-   Laravel 12
-   Blade Templates
-   MySQL
-   Chart.js (for monthly expense visualization)

## License

This project is open-source and available under the [MIT
License](LICENSE).
