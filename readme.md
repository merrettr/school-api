### Install ###

- Copy `.env.example`
- Replace values as needed

```
composer install
php artisan migrate:refresh --seed
php artisan passport:install
```