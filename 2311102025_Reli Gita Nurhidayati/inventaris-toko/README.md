<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br>APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h2>MODUL 11, 12, 13 <br>LARAVEL - INVENTARIS TOKO</h2>
  <br />
  <br />
  <img src="Logo_Telkom.png" alt="Logo Telkom" width="300">
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Reli Gita Nurhidayati</strong><br>
    <strong>2311102025</strong><br>
    <strong>S1 IF-11-REG 02</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  <br />
  <h4>Asisten Praktikum :</h4>
  <strong>Apri Pandu Wicaksono</strong><br>
  <strong>Rangga Pradarrell Fathi</strong>
  <br /><br />
  <h2>LABORATORIUM HIGH PERFORMANCE
  <br>FAKULTAS INFORMATIKA
  <br>UNIVERSITAS TELKOM PURWOKERTO
  <br>2026</h2>
</div>

---

# 1. Dasar Teori

**Laravel Framework** merupakan kerangka kerja PHP terbuka (open-source) berdesain MVC (Model-View-Controller) yang digunakan untuk mendukung pengembangan aplikasi web secara cepat (Rapid Application Development). Framework ini menawarkan berbagai fitur built-in seperti Routing terdedikasi, ORM (Object-Relational Mapping) dengan sistem Eloquent, dan Blade Template Engine.

**MVC (Model-View-Controller)** merupakan pola arsitektur perangkat lunak yang membagi aplikasi menjadi tiga komponen utama:
- **Model** : bertugas mengelola data dan berinteraksi dengan database menggunakan Eloquent ORM
- **View** : bertanggung jawab menampilkan data kepada pengguna menggunakan Blade Template Engine
- **Controller** : menghubungkan Model dan View serta mengatur alur logika aplikasi

**Database Factory dan Seeder** merupakan fitur Laravel yang digunakan untuk menghasilkan data secara otomatis ke dalam database. Factory membuat data dummy, sedangkan Seeder memasukkan data ke dalam database untuk kebutuhan testing maupun inisialisasi data awal.

**Sistem Autentikasi dengan Session** — Laravel menyediakan sistem autentikasi yang aman menggunakan `Auth::attempt()` untuk verifikasi login, middleware `auth` untuk proteksi route, dan session untuk menyimpan status login pengguna selama sesi berlangsung.

**Blade Template Engine** merupakan template engine bawaan Laravel yang memungkinkan penggunaan sintaks sederhana seperti `@extends`, `@section`, `@if`, `@foreach`, dan komponen reusable untuk menghasilkan tampilan yang bersih dan modular.

---

# 2. Tugas Modul 11, 12, 13 - Laravel Invanteris Toko

Pada tugas ini dibuat sebuah aplikasi web **Sistem Inventaris Toko Mas Aimar** berbasis Laravel. Aplikasi ini memungkinkan pengelola toko untuk mengelola data inventaris produk secara efisien dengan fitur CRUD lengkap, autentikasi session, dan tampilan DataTable interaktif.

Teknologi yang digunakan dalam tugas ini antara lain:
- **PHP 8.2+** dengan **Laravel 11**
- **MySQL** sebagai database
- **Bootstrap 5.3** untuk styling UI
- **Bootstrap Icons** untuk ikon
- **DataTables 1.13** + **jQuery** untuk tabel interaktif
- **Google Fonts - Poppins** untuk tipografi

---

# 3. Fitur Sistem

Sistem yang dibangun memiliki fitur-fitur sebagai berikut:

- Login & Logout dengan autentikasi berbasis Session Laravel
- Dashboard dengan statistik card (total produk, stok, nilai inventaris)
- Daftar produk dalam tabel DataTable (search, sort, pagination 10 per halaman)
- Form tambah produk (Create) dengan validasi input sisi server
- Form edit produk (Update) dengan data pre-filled
- Konfirmasi modal sebelum menghapus produk (Delete)
- Halaman detail produk
- Indikator stok berwarna: 🔴 kritis (≤10), 🟡 rendah (≤30), 🟢 aman (>30)
- Badge kategori berwarna untuk setiap jenis produk
- Database Factory menghasilkan 25 produk dummy otomatis
- Database Seeder mengisi 2 akun user dan 25 produk saat pertama dijalankan
- Watermark NIM dan Nama di setiap halaman

---

# 4. Source Code

### routes/web.php
```php
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
});
```

### app/Http/Controllers/AuthController.php
```php
<?php
// 2311102025 - Reli Gita Nurhidayati
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        if (Auth::check()) return redirect()->route('products.index');
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('products.index'));
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
```

### app/Http/Controllers/ProductController.php
```php
<?php
// 2311102025 - Reli Gita Nurhidayati
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products    = Product::latest()->paginate(10);
        $totalProduk = Product::count();
        $totalStok   = Product::sum('stok');
        $totalNilai  = Product::selectRaw('SUM(harga * stok) as total')->value('total');
        return view('products.index', compact('products', 'totalProduk', 'totalStok', 'totalNilai'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string|max:1000',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, Product $product) {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
```

### app/Models/Product.php
```php
<?php
// 2311102025 - Reli Gita Nurhidayati
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_produk', 'kategori', 'stok', 'harga', 'deskripsi',
    ];
}
```

### database/factories/ProductFactory.php
```php
<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array {
        $kategori = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman',
                     'Peralatan Rumah', 'Alat Tulis', 'Mainan', 'Kosmetik'];
        $cat = $this->faker->randomElement($kategori);
        return [
            'nama_produk' => $this->faker->words(2, true),
            'kategori'    => $cat,
            'stok'        => $this->faker->numberBetween(5, 150),
            'harga'       => $this->faker->randomElement([5000, 10000, 25000, 50000, 100000, 150000]),
            'deskripsi'   => $this->faker->sentence(8),
        ];
    }
}
```

### database/seeders/DatabaseSeeder.php
```php
<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void {
        User::factory()->create([
            'name'     => 'Admin Toko',
            'email'    => 'admin@toko.com',
            'password' => bcrypt('password123'),
        ]);
        User::factory()->create([
            'name'     => 'Mas Aimar',
            'email'    => 'aimar@toko.com',
            'password' => bcrypt('password123'),
        ]);
        Product::factory(25)->create();
    }
}
```

---

# 5. Output / Tampilan Aplikasi

### A. Halaman Login
Halaman login diakses pertama kali saat membuka aplikasi. Pengguna memasukkan email dan password yang telah terdaftar melalui seeder.

**Akun Demo:**
| Role | Email | Password |
|------|-------|----------|
| Admin Toko | admin@toko.com | password123 |
| Mas Aimar | aimar@toko.com | password123 |

<img src="Login Inventaris Toko.png" alt="Tampilan Login" width="600">

---

### B. Halaman Dashboard / Daftar Produk
Menampilkan statistik card (total produk, stok, nilai inventaris) dan tabel DataTable interaktif dengan fitur search, sort, dan pagination.

<img src="Tampilan dashboard inventaris toko.png" alt="Tampilan Dashboard" width="700">

---

### C. Halaman Tambah Produk (Create)
Form untuk menambahkan produk baru dengan validasi input sisi server dan panel tips di samping form.

<img src="Create inventaris toko.png" alt="Tampilan Create" width="700">

---

### D. Halaman Edit Produk (Update)
Form edit dengan data produk pre-filled dan informasi data sebelum diedit di bagian bawah form.

<img src="Edit inventaris toko.png" alt="Tampilan Edit" width="700">

---

### E. Konfirmasi Hapus Produk (Delete)
Modal konfirmasi muncul sebelum data produk dihapus untuk mencegah penghapusan yang tidak disengaja.

<img src="Hapus inventaris toko.png" alt="Tampilan Hapus" width="700">

---

# 6. Struktur Folder

```
inventaris-toko/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php      (login & logout session)
│   │       └── ProductController.php   (CRUD produk)
│   └── Models/
│       └── Product.php                 (model produk + fillable)
├── database/
│   ├── factories/
│   │   └── ProductFactory.php          (generator 25 data dummy)
│   ├── migrations/
│   │   └── ..._create_products_table.php
│   └── seeders/
│       └── DatabaseSeeder.php          (2 akun user + 25 produk)
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           (layout utama navbar + sidebar)
│       ├── auth/
│       │   └── login.blade.php         (halaman login)
│       └── products/
│           ├── index.blade.php         (daftar produk + DataTable)
│           ├── create.blade.php        (form tambah produk)
│           ├── edit.blade.php          (form edit produk)
│           └── show.blade.php          (detail produk)
├── routes/
│   └── web.php                         (definisi semua route)
├── Logo_Telkom.png                     (logo kampus)
└── .env                                (konfigurasi database & session)
```

---

# 7. Cara Menjalankan Program

Berikut adalah langkah-langkah untuk menjalankan program:

1. Pastikan XAMPP sudah aktif (Apache + MySQL)
2. Clone atau download repository ini
3. Masuk ke folder project:
   ```bash
   cd inventaris-toko
   ```
4. Install dependencies:
   ```bash
   composer install
   ```
5. Copy file environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
6. Buat database `inventaris_toko` di phpMyAdmin, lalu edit file `.env`:
   ```
   DB_DATABASE=inventaris_toko
   DB_USERNAME=root
   DB_PASSWORD=
   ```
7. Jalankan migration dan seeder:
   ```bash
   php artisan migrate --seed
   ```
8. Jalankan server:
   ```bash
   php artisan serve
   ```
9. Buka browser dan akses `http://localhost:8000`
10. Login menggunakan akun: **admin@toko.com** / **password123**

---

# 8. Kesimpulan

Pada praktikum modul 11, 12, dan 13 ini, praktikan berhasil mengimplementasikan 
aplikasi web inventori toko berbasis framework Laravel dengan menerapkan pola 
arsitektur Model-View-Controller (MVC) secara menyeluruh. Sistem autentikasi 
berbasis session berhasil dibangun menggunakan Auth::attempt() dan middleware auth 
untuk memproteksi route dari akses yang tidak sah. Operasi CRUD pada data produk 
berjalan optimal melalui abstraksi Eloquent ORM tanpa penulisan query SQL secara 
manual. Tampilan antarmuka menggunakan Bootstrap 5 dan DataTables menghasilkan 
pengalaman pengguna yang interaktif dengan fitur pencarian, pengurutan, dan 
pagination. Database Factory dan Seeder berhasil dimanfaatkan untuk mengisi 
database dengan 25 data produk dummy secara otomatis sehingga aplikasi siap 
digunakan sejak pertama dijalankan.

Kesimpulannya, framework Laravel terbukti mempercepat proses pengembangan aplikasi web melalui fitur-fitur terintegrasi yang siap pakai, menghasilkan kode yang terstruktur, mudah dibaca, dan mudah dikembangkan lebih lanjut.

---

# 9. Referensi

- Laravel Framework Documentation, Release 11.x — https://laravel.com/docs
- Bootstrap (v5.3) Components & Framework — https://getbootstrap.com/docs/5.3/
- DataTables – Table plug-in for jQuery — https://datatables.net/
- Bootstrap Icons — https://icons.getbootstrap.com/
- Laravel Official Documentation – Database Seeding — https://laravel.com/docs/11.x/seeding

---

</div>
