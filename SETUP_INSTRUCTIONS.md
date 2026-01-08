BreadSMG — Integration and setup

This workspace contains the integrated Admin and Landing templates and a basic implementation for a bakery shop (menus, cart, orders).

Steps to run locally:

1. Copy `.env.example` to `.env` and set MySQL credentials (DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
2. Run composer install if needed and then run migrations and seeders:

    php artisan migrate --seed

3. Make sure `public/template-assets` exists (the templates are copied here) and `public/images/menus` is writable.
4. Start the development server (Laragon or):

    php artisan serve

5. Visit:
    - Home: http://localhost:8000/
    - Admin Menus: http://localhost:8000/admin/menus

Notes:

-   Image uploads for menus are saved to `public/images/menus`.
-   The cart is session-based and supports multiple items.
-   If `php artisan migrate` fails, ensure your DB credentials in `.env` are correct and the MySQL server is running.

If you want, I can add admin authentication and polish templates further.
