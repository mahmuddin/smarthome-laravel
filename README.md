# SmartHome REST API

SmartHome REST API adalah backend aplikasi untuk sistem manajemen rumah pintar yang dibangun menggunakan Laravel 12 dan PHP 8.4. API ini menyediakan berbagai endpoint untuk mengelola perangkat, sensor, dan automasi rumah pintar secara efisien dan aman.

## Teknologi yang Digunakan

-   **Laravel 12**: Framework PHP modern untuk pengembangan aplikasi web dan REST API.
-   **PHP 8.4**: Versi terbaru PHP yang menawarkan performa tinggi dan fitur-fitur terbaru.
-   **MySQL/MariaDB**: Database relasional untuk penyimpanan data.
-   **JWT Authentication**: Untuk keamanan dan otorisasi akses API.
-   **Swagger/OpenAPI**: Dokumentasi interaktif untuk endpoint API.

## Fitur Utama

-   Manajemen perangkat rumah pintar (tambah, ubah, hapus, lihat)
-   Monitoring sensor secara real-time
-   Automasi dan pengaturan skenario rumah pintar
-   Sistem autentikasi dan otorisasi berbasis token

## Cara Instalasi

1. Clone repository ini.
2. Jalankan `composer install`.
3. Copy `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
4. Jalankan `php artisan key:generate`.
5. Jalankan migrasi database dengan `php artisan migrate`.
6. Jalankan seeder untuk mengisi data awal dengan `php artisan db:seed --class=SuperAdminSeeder`.
7. Jalankan server lokal dengan `php artisan serve`.

## Dokumentasi API

Dokumentasi lengkap tersedia pada endpoint `/api/documentation` (menggunakan Swagger/OpenAPI).

---

Kontribusi dan saran sangat terbuka untuk pengembangan lebih lanjut.
