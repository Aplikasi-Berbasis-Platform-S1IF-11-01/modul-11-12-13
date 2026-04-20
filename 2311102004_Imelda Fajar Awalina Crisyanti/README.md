<h1 align="center">LAPORAN PRAKTIKUM</h1>
<h1 align="center">APLIKASI BERBASIS PLATFORM</h1>

<br>

<h2 align="center">MODUL 11, 12, 13</h2>
<h2 align="center">LARAVEL - INVENTORI TOKO</h2>

<br><br>

<p align="center">
  <img src="asset/logo.png" width="300">
</p>

<br><br>

<h2 align="center">Disusun Oleh :</h2>

<p align="center">
  <b>Imelda Fajar Awalina Crisyanti</b><br>
  <b>2311102004</b><br>
  <b>S1 IF-11</b>
</p>

<br>

<h2 align="center">Dosen Pengampu :</h2>

<p align="center">
  <b>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</b>
</p>

<br>

<h2 align="center">Asisten Praktikum :</h2>

<p align="center">
  <b>Apri Pandu Wicaksono</b><br>
  <b>Rangga Pradarrell Fathi</b>
</p>

<br>

<h1 align="center">LABORATORIUM HIGH PERFORMANCE</h1>
<h1 align="center">FAKULTAS INFORMATIKA</h1>
<h1 align="center">UNIVERSITAS TELKOM PURWOKERTO</h1>
<h1 align="center">TAHUN 2026</h1>

---

## 1. DASAR TEORI

### Laravel dalam Pengembangan Aplikasi

Dalam pembuatan aplikasi inventori toko pada praktikum ini, digunakan Laravel sebagai kerangka kerja utama. Laravel dipilih karena memiliki struktur yang sudah terorganisir sehingga memudahkan dalam membangun aplikasi berbasis web.

Laravel menyediakan berbagai fitur yang langsung dapat digunakan, seperti pengaturan route, pengelolaan data dengan ORM, serta sistem autentikasi. Dengan adanya fitur tersebut, proses pengembangan aplikasi menjadi lebih cepat karena tidak perlu membangun semuanya dari awal.

### Penerapan Pola MVC pada Aplikasi

Pada aplikasi yang dibuat, konsep MVC diterapkan untuk membagi tugas dalam sistem.

Bagian Model digunakan untuk mengelola data produk yang tersimpan di database.
Bagian View digunakan untuk menampilkan halaman seperti login, dashboard, dan data produk.
Bagian Controller digunakan untuk mengatur proses seperti menambah, mengubah, dan menghapus data.

Dengan pembagian tersebut, setiap bagian memiliki peran masing-masing sehingga kode menjadi lebih rapi dan tidak tercampur antara tampilan dan logika program.

### Pengelolaan Data dengan Seeder

Dalam tahap pengembangan, diperlukan data awal untuk mencoba fitur yang dibuat. Oleh karena itu digunakan Seeder untuk memasukkan data ke dalam database.

Dengan adanya data ini, fitur seperti pencarian, pengeditan, dan penghapusan produk dapat langsung diuji tanpa harus memasukkan data secara manual satu per satu.

### Mekanisme Login pada Sistem

Aplikasi ini memiliki fitur login yang berfungsi untuk membatasi akses pengguna. Hanya pengguna yang berhasil login yang dapat mengakses halaman utama aplikasi.

Laravel memanfaatkan session untuk menyimpan informasi login, sehingga pengguna tidak perlu login ulang setiap kali berpindah halaman. Selain itu, digunakan middleware untuk memastikan halaman tertentu tidak dapat diakses tanpa proses autentikasi.

### Penggunaan Blade pada Tampilan

Dalam pembuatan tampilan, digunakan Blade Template yang mempermudah pengelolaan halaman. Dengan Blade, beberapa bagian tampilan seperti header dan layout dapat digunakan kembali di banyak halaman.

Hal ini membuat kode tampilan menjadi lebih ringkas dan mudah dipahami. Selain itu, Blade juga mempermudah dalam menampilkan data dari database ke halaman web.
---

## 2. SOURCE CODE

Source code untuk pengerjaan project **Laravel - Inventori Toko** secara lengkap terdapat pada folder project aplikasi ini, khususnya di dalam folder `/inventori-toko`.

### A. Routing (`routes/web.php`)
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root & dashboard
Route::get('/', function () {
    return redirect()->route('products.index');
});
Route::get('/dashboard', function () {
    return redirect()->route('products.index');
});

// Protected Routes
Route::middleware(\App\Http\Middleware\AuthMiddleware::class)->group(function () {
    Route::resource('products', ProductController::class);
});
