# Sistem Informasi Keuangan
Sistem Informasi Keuangan merupakan aplikasi berbasis website yang ditujukan untuk menunjang Tugas Akhir (Skripsi). Dibangun dengan Framework Laravel 10 dan Menggunakan Template Bootstrap 5.

## Tech
- [Laravel 10](https://laravel.com/) - The PHP Framework for Web Artisans
- [Bootstrap 5](https://getbootstrap.com/) - Build fast, responsive sites with Bootstrap
- [Font Awesome](https://fontawesome.com/) - Take the hassle out of icons in your website.

## Installation
Laravel 10.x requires a minimum PHP version of 8.1 to run.

Git Clone:
```sh
git clone https://github.com/putragstn/sistem-informasi-keuangan.git
```

Change Directory Into Project:
```sh
cd sistem-informasi-keuangan
```

Install Composer Dependencies, to install Vendor file Laravel:
```sh
composer install
```

Copy .env file:
```sh
cp .env.example .env
```

Generate an app encryption key:
```sh
php artisan key:generate
```

Migrate the database:
```sh
php artisan migrate
```

Seed the database (optional):
```sh
php artisan db:seed
```

Run Laravel:
```sh
php artisan serve
```
or
```sh
php artisan ser
```
