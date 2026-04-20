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

### Laravel Framework
Laravel merupakan framework PHP open-source yang menggunakan pola arsitektur MVC (*Model-View-Controller*). Framework ini dirancang untuk mempermudah pengembangan aplikasi web secara cepat, terstruktur, dan efisien. Laravel menyediakan berbagai fitur bawaan seperti routing, middleware, ORM Eloquent, autentikasi, migration, seeder, serta Blade Template Engine yang membantu proses pengembangan aplikasi menjadi lebih mudah.

### MVC (Model-View-Controller)
MVC adalah pola arsitektur perangkat lunak yang membagi aplikasi menjadi tiga komponen utama, yaitu:

- **Model**: bertugas mengelola data dan berinteraksi dengan database.
- **View**: bertanggung jawab menampilkan data kepada pengguna.
- **Controller**: menghubungkan Model dan View serta mengatur logika aplikasi.

Dalam Laravel, konsep MVC diterapkan secara penuh sehingga struktur aplikasi menjadi lebih rapi, mudah dikembangkan, dan lebih mudah dipelihara.

### Database Factory dan Seeder
Factory dan Seeder merupakan fitur Laravel yang digunakan untuk membuat serta mengisi data otomatis ke dalam database.

- **Factory** digunakan untuk membuat data dummy atau data uji.
- **Seeder** digunakan untuk mengisi data awal ke dalam database.

Fitur ini sangat membantu saat proses pengembangan dan pengujian aplikasi, terutama ketika data asli belum tersedia.

### Sistem Autentikasi dengan Session
Autentikasi adalah proses verifikasi identitas pengguna dalam sistem. Laravel menyediakan sistem autentikasi berbasis session yang aman dan mudah digunakan. Session digunakan untuk menyimpan status login pengguna sehingga selama session masih aktif, pengguna dapat mengakses halaman yang dilindungi.

### Blade Template Engine
Blade adalah template engine bawaan Laravel yang digunakan untuk membuat tampilan aplikasi. Blade memiliki sintaks yang sederhana namun tetap fleksibel, seperti:

- `@extends`
- `@section`
- `@if`
- `@foreach`

Blade membantu developer membuat tampilan yang lebih bersih, modular, dan mudah dipahami.

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
