# ⚡ Panduan Instalasi Cepat — Toko Aimar

## Prasyarat
- PHP 8.2+
- Composer
- (Opsional) MySQL/MariaDB — default pakai SQLite

---

## Langkah-Langkah

```bash
# 1. Masuk ke folder project
cd toko-aimar

# 2. Install semua dependency PHP
composer install

# 3. Salin konfigurasi environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Jalankan migrasi & seeder (buat semua tabel + data awal)
php artisan migrate --seed

# 6. Jalankan server development
php artisan serve
```

Buka browser → **http://localhost:8000**

---

## Akun Siap Pakai

| Nama | Email | Password | Akses |
|------|-------|----------|-------|
| Pak Cik | pakcik@tokoaimar.com | pakcik123 | Admin |
| Mas Aimar | aimar@tokoaimar.com | aimar123 | Admin |
| Mas Jakobi | jakobi@gmail.com | jakobi123 | Belanja |

---

## Pakai MySQL? Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toko_aimar
DB_USERNAME=root
DB_PASSWORD=your_password
```

Lalu buat database: `CREATE DATABASE toko_aimar;`  
Kemudian jalankan ulang: `php artisan migrate --seed`

---

## Reset Data

```bash
php artisan migrate:fresh --seed
```

---

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Storage permission error | `chmod -R 775 storage bootstrap/cache` |
| Key not set | `php artisan key:generate` |
| Class not found | `composer dump-autoload` |
| View not found | `php artisan view:clear` |
