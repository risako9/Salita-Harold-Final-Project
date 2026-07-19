# Abuela Cantina Laravel Website

The original static Abuela Cantina website has been converted to Laravel Blade views while preserving its design, content, and responsive behavior.

## Local setup

```bash
composer install
copy .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File -Force
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open `http://127.0.0.1:8000` for the homepage or `http://127.0.0.1:8000/order` for the order page.

## Good Stuff picture manager

Open `http://127.0.0.1:8000/admin/login` and sign in with the credentials configured by `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env`. Change the default password before deploying the site publicly.

Uploaded JPG, PNG, and WebP pictures are stored under `storage/app/public/good-stuff` and served through Laravel's public storage link.

## Routes

- `home` — `/`
- `order` — `/order`

## Tests

```bash
php artisan test
```
