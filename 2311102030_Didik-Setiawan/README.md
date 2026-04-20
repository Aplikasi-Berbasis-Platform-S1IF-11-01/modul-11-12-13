<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br>APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h3>MODUL 11-12-13 <br> LARAVEL APLIKASI INVENTORI SEMBAKO  </h3>
  <br />
  <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-vb7jyBjK-sM%2FXXfKp51LrjI%2FAAAAAAAACts%2FEjcXzlgZwSswNWXsBHMyX-6aav1mjA77QCPcBGAYYCw%2Fs1600%2FLogo_Telkom_University_potrait.png&f=1&nofb=1&ipt=9d030d54102ea96369d39fe491220e0536195abc8ee443279c1a420302206400" alt="Logo Telkom" width="300"> 
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Didik Setiawan</strong><br>
    <strong>2311102030</strong><br>
    <strong>IF-11-REG01</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  <br />
  <br />
    <h4>Asisten Praktikum :</h4>
    <strong> Apri Pandu Wicaksono </strong> <br>
    <strong>Rangga Pradarrell Fathi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE
 <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026</h3>
</div>

---
## Sistem Inventaris Toko Pak Cik & Mas Aimar

Aplikasi manajemen inventaris berbasis web untuk memudahkan pengelolaan produk toko buku.

---

##  Deskripsi Project

Proyek ini dikembangkan sebagai tugas untuk Modul 11, 12, dan 13, yang bertujuan membangun sistem inventaris toko milik Pak Cik dan Mas Aimar. Aplikasi ini dibuat menggunakan Laravel 12, dilengkapi dengan fitur CRUD produk yang lengkap, sistem autentikasi berbasis session, serta antarmuka modern yang dirancang menggunakan Vanilla CSS dan Simple DataTables.

---

##  Fitur Utama

| Fitur | Keterangan |
|---|---|
|  **Autentikasi** | Login/Logout dengan sistem session Laravel |
|  **CRUD Produk** | Create, Read, Update, Delete produk |
|  **DataTable** | Tampilan tabel interaktif dengan search, sort, pagination menggunakan Simple DataTables |
|  **Delete Modal** | Konfirmasi hapus menggunakan Custom Modal HTML/CSS native |
|  **Seeder + Factory** | Data dummy otomatis agar database tidak kosong (50 produk dummy) |
|  **Dokumentasi** | README lengkap + UI yang sudah distyling rapi dengan Vanilla CSS |

---

##  Teknologi yang Digunakan

- **Backend:** Laravel 12 (PHP 8.2+)
- **Database:** MySQL / SQLite
- **Frontend:** Vanilla CSS, Boxicons untuk ikon
- **Data Table:** Simple DataTables (Vanilla JS)
- **Autentikasi:** Laravel Session (built-in)
- **Template Engine:** Blade

---

##  Cara Instalasi & Menjalankan Project

### 1. Clone / Download Project

```bash
git clone https://github.com/Aplikasi-Berbasis-Platform-S1IF-11-01/modul-11-12-13/tree/main/2311102030_Didik-Setiawan
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuaikan database (Secara default Laravel menggunakan SQLite saat ini yang sangat praktis):

```env
DB_CONNECTION=sqlite
```
> **Tips:** Jika menggunakan SQLite, jalankan perintah ini di terminal untuk membuat file database:
> ```bash
> touch database/database.sqlite
> ```

### 4. Migrate & Seed Database

```bash
php artisan migrate
php artisan db:seed
```

Perintah ini akan:
- Membuat tabel `users` dan `products`
- Membuat akun admin default (Mas Jakobi)
- Membuat 50 data produk dummy menggunakan factory

### 5. Jalankan Server

```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

##  Akun Admin Pusat

| Nama | Email | Password |
|---|---|---|
| `Mas Jakobi` | `admin@example.com` | `password` |

---

##  Struktur File Penting

```
inventaris-toko/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php        ← Login/Logout
│   │   │   └── ProductController.php     ← CRUD Produk
│   │   └── Middleware/
│   │       └── AuthMiddleware.php        ← Guard session (guest & auth)
│   └── Models/
│       ├── User.php
│       └── Product.php
├── database/
│   ├── factories/
│   │   └── ProductFactory.php            ← Factory data dummy (50 data)
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php
│   │   └── xxxx_create_products_table.php
│   └── seeders/
│       └── DatabaseSeeder.php            ← Menjalankan factory & admin dummy
├── public/
│   └── css/
│       └── style.css                     ← Custom styling Vanilla CSS
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php             ← Template utama aplikasi
│       ├── auth/
│       │   └── login.blade.php           ← Halaman login kustom
│       └── products/
│           ├── index.blade.php           ← View: DataTable daftar produk
│           ├── create.blade.php          ← View: Form tambah produk
│           └── edit.blade.php            ← View: Form edit produk
└── routes/
    └── web.php                           ← Definisi route autentikasi & produk
```

---

##  Daftar Route

| Method | URL | Controller | Keterangan |
|---|---|---|---|
| GET | `/login` | AuthController@showLogin | Halaman login |
| POST | `/login` | AuthController@login | Proses autentikasi login |
| POST | `/logout` | AuthController@logout | Proses logout (auth guard) |
| GET | `/` | redirect `login` | Redirect ke halaman login / utama |
| GET | `/products` | ProductController@index | Membaca semua daftar produk |
| GET | `/products/create` | ProductController@create | Menampilkan form tambah |
| POST | `/products` | ProductController@store | Eksekusi simpan produk |
| GET | `/products/{id}/edit` | ProductController@edit | Menampilkan form edit |
| PUT/PATCH | `/products/{id}` | ProductController@update | Eksekusi update produk |
| DELETE | `/products/{id}` | ProductController@destroy | Eksekusi hapus produk |

---

##  Struktur Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK) | Primary key |
| name | varchar | Nama user |
| email | varchar (unique) | Email login |
| email_verified_at| timestamp | Waktu verifikasi email |
| password | varchar | Password (hashed) |
| remember_token | varchar | Token untuk remember me |
| created_at | timestamp | Waktu data dibuat |
| updated_at | timestamp | Waktu data diupdate |

### Tabel `products`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK) | Primary key |
| name | varchar | Nama produk |
| description | text (nullable) | Deskripsi produk opsional |
| price | decimal(12,2) | Harga satuan (mendukung nominal hingga triliun) |
| stock | integer | Jumlah stok default(0) |
| created_at | timestamp | Waktu data dibuat |
| updated_at | timestamp | Waktu data diupdate |

---

##  Catatan Teknis Tambahan

### UI / UX Modern Tanpa Bootstrap
Aplikasi ini di-desain menggunakan **Vanilla CSS** secara total dengan layout flexbox dan UI modern yang responsif. Menghindari pemakaian framework styling ukuran besar demi performa load dan rendering yang lebih cepat.

### Simple DataTables (Vanilla JS)
Berbeda dengan traditional DataTables yang membutuhkan library jQuery, aplikasi ini memakai *simple-datatables* yang dibangun dengan Native/Vanilla JavaScript. Proses loading tabel dan iterasi data jauh lebih optimal dan tidak bergantung pada library jadul.

---

##  Dibuat Untuk

Project ini dibuat untuk memenuhi **Tugas Modul 11, 12, 13** — Inventari Toko Pak Cik & Mas Aimar (Pengembangan Modul Baru).

---
## Hasil
**1. login**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20202606.png)
**2. Tampilan Awal**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20202626.png)
**3. Tambah Product**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20203715.png)
**4. Setelah Tambah Product**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20203727.png)
**5. Edit Product**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20204015.png)
**6. Setelah Edit Product**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20204028.png)
**7. Hapus Product**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20204320.png)
**8. Setelah Hapus Product**
![Tampilan Awal](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/Screenshot%202026-04-20%20204333.png)
