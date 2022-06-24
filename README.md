Ini adalah aplikasi integrated change control system yang digunakan untuk tracking perubahan dokumen di perusahaan.
Saat ini masih dalam tahap pengembangan

Step :
- Download Code
- Jalankan composer update atau composer dump-autoload
- Setting Database di file .env
- Setting Database di config\database.php
- Lakukan migrasi database (php artisan migrate)
- Siapkan table old_users, old_flpparents, old_flpfiles, old_flpactions
- Jika point 3 tidak ada, jangan jalankan seeder
- Jika point 3 ada, jalankan seeder

Requirement :
- PHP 8.1
- Laravel 9
- Install Image Magix from https://mlocati.github.io/articles/php-windows-imagick.html (version 8.1)
- Setting php.ini =>extension=php_imagick.dll
- Setting php.ini => extension=gd
