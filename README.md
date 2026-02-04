# Great Purse

Laravel + Livewire project. Runs locally via OpenServer (OSPanel).

## Stack
- Laravel 12
- Livewire 3
- PHP 8.2+
- Vite + Tailwind CSS

## Local setup
1. Point your OpenServer domain to the `public/` folder.
2. `composer install`
3. `npm install`
4. Copy `.env.example` to `.env` and set `DB_*`.
5. `php artisan key:generate`
6. `php artisan migrate`
7. `npm run dev`
