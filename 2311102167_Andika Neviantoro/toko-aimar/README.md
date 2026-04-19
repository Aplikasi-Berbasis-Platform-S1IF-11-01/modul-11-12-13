# 🏪 Toko Aimar — Web Inventari

> Sistem manajemen inventari dan belanja online untuk **Toko Pak Cik & Mas Aimar**.
> Dibangun dengan **Laravel 11**, **Bootstrap 5**, dan **DataTables**.

---

## 📋 Fitur Utama

### 👨‍💼 Panel Admin (Pak Cik & Mas Aimar)
| Fitur | Keterangan |
|---|---|
| **Login/Logout** | Autentikasi berbasis session |
| **Dashboard** | Statistik produk (total, tersedia, menipis, habis) |
| **DataTable Produk** | Tabel interaktif dengan pencarian & sorting bawaan |
| **Tambah Produk** | Form lengkap dengan validasi |
| **Edit Produk** | Update data produk yang ada |
| **Hapus Produk** | Soft delete dengan konfirmasi modal |

### 🛍️ Panel Belanja (Mas Jakobi & Customer)
| Fitur | Keterangan |
|---|---|
| **Katalog Produk** | Grid produk dengan filter & pencarian |
| **Keranjang Belanja** | Session-based cart, update quantity |
| **Checkout** | Simpan order ke database & potong stok |
| **Registrasi** | Daftar akun baru sebagai customer |

---

## 🚀 Cara Setup & Menjalankan

### 1. Clone / Ekstrak Project
```bash
cd /var/www    # atau folder pilihan Anda
# ekstrak ZIP project ini
cd toko-aimar
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database
Default menggunakan **SQLite** (tanpa konfigurasi tambahan).
```bash
# Buat file database SQLite
touch database/database.sqlite

# Jalankan migrasi + seeder
php artisan migrate --seed
```

Untuk MySQL, edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toko_aimar
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Server
```bash
php artisan serve
```
Buka browser: **http://localhost:8000**

---

## 🔑 Akun Default

| Nama | Email | Password | Role |
|---|---|---|---|
| **Pak Cik** | pakcik@tokoaimar.com | pakcik123 | Admin |
| **Mas Aimar** | aimar@tokoaimar.com | aimar123 | Admin |
| **Mas Jakobi** | jakobi@gmail.com | jakobi123 | Customer |

> Seeder juga menghasilkan **50 produk acak** dan **7 customer tambahan**.

---

## 🗂️ Struktur Project

```
toko-aimar/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php       # Login, Register, Logout
│   │   │   ├── ProductController.php    # CRUD Produk (Admin)
│   │   │   ├── ShopController.php       # Katalog belanja (Customer)
│   │   │   └── CartController.php       # Keranjang & Checkout
│   │   └── Middleware/
│   │       └── RoleMiddleware.php       # Guard role admin/customer
│   └── Models/
│       ├── User.php
│       ├── Product.php                  # Dengan SoftDeletes
│       ├── Order.php
│       └── OrderItem.php
│
├── database/
│   ├── factories/
│   │   ├── UserFactory.php
│   │   └── ProductFactory.php           # 8 kategori, produk realistis
│   ├── migrations/
│   │   ├── ..._create_users_table.php
│   │   ├── ..._create_products_table.php
│   │   └── ..._create_orders_table.php
│   └── seeders/
│       └── DatabaseSeeder.php           # Seed user & 50 produk
│
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php               # Layout utama + sidebar
│   │   └── auth.blade.php              # Layout halaman login/register
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── products/
│   │   ├── index.blade.php             # DataTable + modal delete
│   │   ├── create.blade.php            # Form tambah produk
│   │   └── edit.blade.php              # Form edit produk
│   └── shop/
│       ├── index.blade.php             # Katalog produk (grid)
│       └── cart.blade.php              # Keranjang belanja
│
└── routes/
    └── web.php                         # Semua routing
```

---

## 🛡️ Sistem Role & Akses

```
/login, /register          → Guest only
/admin/*                   → Admin only  (role: admin)
/shop, /cart/*             → Customer only (role: customer)
```

Middleware `role:admin` dan `role:customer` menjaga setiap route grup.
Admin yang coba akses `/shop` akan di-redirect ke dashboard, dan sebaliknya.

---

## 🗄️ Skema Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| name | varchar | Nama user |
| email | varchar | Email unik |
| password | varchar | Hashed |
| role | enum | `admin` / `customer` |

### Tabel `products`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| name | varchar | Nama produk |
| description | text | Deskripsi (nullable) |
| price | decimal(12,2) | Harga |
| stock | int | Jumlah stok |
| category | varchar | Kategori |
| sku | varchar | Kode unik produk |
| deleted_at | timestamp | Soft delete |

### Tabel `orders`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| user_id | FK → users | Pembeli |
| total_price | decimal | Total harga |
| status | enum | pending/processing/completed/cancelled |
| note | text | Catatan pembeli |

### Tabel `order_items`
| Kolom | Tipe | Keterangan |
|---|---|---|
| order_id | FK → orders | |
| product_id | FK → products | |
| quantity | int | Jumlah |
| price | decimal | Harga saat beli |

---

## 🛠️ Tech Stack

| Teknologi | Versi | Fungsi |
|---|---|---|
| Laravel | 11.x | PHP Framework |
| PHP | 8.2+ | Backend |
| SQLite / MySQL | - | Database |
| Bootstrap | 5.3 | UI Framework |
| Bootstrap Icons | 1.11 | Ikon |
| DataTables | 1.13 | Tabel interaktif |
| jQuery | 3.7 | JS helper |

---

## 🧪 Artisan Commands Berguna

```bash
# Jalankan semua migrasi + seeder dari awal
php artisan migrate:fresh --seed

# Lihat semua route
php artisan route:list

# Buka tinker (REPL)
php artisan tinker

# Clear cache
php artisan cache:clear && php artisan config:clear
```

---

## 📝 Catatan Pengembangan

- **Soft Delete**: Produk yang dihapus tidak benar-benar hilang dari database (bisa dipulihkan).
- **Session Cart**: Keranjang belanja disimpan di session, bukan database — cocok untuk toko skala kecil.
- **SoftDeletes** on Product: data historis order tetap aman meski produk "dihapus".
- **Role Middleware**: Pisah akses admin & customer secara bersih di level middleware.
- **Seeder Realistis**: `ProductFactory` menghasilkan produk dengan nama & kategori yang masuk akal (bukan lorem ipsum).

---

*Dibuat dengan ❤️ untuk Toko Pak Cik & Mas Aimar — 2024*
