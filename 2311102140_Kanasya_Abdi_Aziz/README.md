<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h3>MODUL 11,12,13 <br> Laravel : CRUD Inventaris, Seeder, Factory, dan Authentication</h3>
  <br />
  <img src="assets/logo.png" alt="Logo" width="300">
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Kanasya Abdi Aziz</strong><br>
    <strong>2311102140</strong><br>
    <strong>S1 IF-11-01</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  <br />
  <br />
  <h4>Asisten Praktikum :</h4>
  <strong>Apri Pandu Wicaksono</strong> <br>
  <strong>Rangga Pradarrell Fathi</strong>
  <br />
  <br />
  <br />
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE <br> FAKULTAS INFORMATIKA <br> UNIVERSITAS TELKOM PURWOKERTO <br> 2026</h3>
</div>

---

## A. Dasar Teori

### 1. Laravel
Laravel adalah salah satu *framework* PHP yang digunakan untuk membangun aplikasi web secara terstruktur, efisien, dan mudah dikembangkan. Laravel employs the **MVC (Model-View-Controller)** architecture, which makes the application development process more efficient since program, tampilan, and data processing are done in accordance with its functions. In this practice, Laravel is used to create an inventory application with features like product data analysis, user authentication, and database integration.

### 2. Konsep MVC (*Model-View-Controller*)
MVC adalah pola perancangan aplikasi yang membagi sistem menjadi tiga bagian utama: "Model", yang mengelola data dan berhubungan dengan database, dan "View", yang menampilkan antarmuka pengguna.

Controller mengatur logika aplikasi dan berfungsi sebagai penghubung antara Model dan View.
Konsep MVC membuat pengembangan kode program untuk fitur baru lebih mudah dan lebih teratur.

### 3. CRUD (*Create, Read, Update, Delete*)
CRUD adalah empat operasi dasar dalam pengelolaan data pada aplikasi:
- **Create**, digunakan untuk menambahkan data baru.
- **Read**, digunakan untuk menampilkan atau membaca data.
- **Update**, digunakan untuk mengubah data yang sudah ada.
- **Delete**, digunakan untuk menghapus data.

Aplikasi inventaris toko menggunakan CRUD untuk mengelola data produk, yang memungkinkan pengguna menambah, melihat, mengubah, dan menghapus informasi barang.

### 4. Database dan MySQL
Database adalah kumpulan data yang disimpan secara sistematis sehingga mudah dikelola dan diakses. Database berfungsi sebagai tempat penyimpanan data penting dalam pengembangan aplikasi web, termasuk data pengguna, produk, kategori, stok, dan transaksi.  
Database yang digunakan dalam praktikum ini adalah MySQL, sistem manajemen basis data relasional yang umum digunakan bersama Laravel. MySQL mendukung penyimpanan data dalam bentuk tabel yang saling berelasi, yang membuatnya ideal untuk aplikasi inventaris.

### 5. Migration
Fitur migrasi Laravel adalah fitur yang memungkinkan pengembang untuk memastikan struktur database konsisten, terutama ketika proyek dikerjakan secara bertahap atau kolaboratif. Ini memungkinkan pembuatan, perubahan, dan penghapusan tabel secara terstruktur tanpa harus menulis perintah SQL secara manual.

### 6. Seeder dan Factory
Seder secara otomatis mengisi database dengan data awal atau data dummy, sedangkan pabrik menghasilkan banyak data tiruan dengan format yang telah ditentukan.  
Seder dan pabrik sangat membantu dalam aplikasi inventaris agar tabel tidak kosong saat aplikasi dimulai. Oleh karena itu, aplikasi dapat diuji langsung dengan data contoh tanpa harus memasukkan semua data secara manual.

### 7. Eloquent ORM
Eloquent ORM adalah fitur Laravel yang memungkinkan interaksi dengan database dengan menggunakan representasi objek atau model. Dengan Eloquent, pengembang tidak selalu perlu menulis query SQL secara langsung karena model PHP memungkinkan pengambilan, penyimpanan, pembaruan, dan penghapusan data. Pada praktikum ini, Eloquent dikelola data produk, kategori, dan pengguna pada aplikasi inventaris.

### 8. Authentication dan Session
Proses verifikasi identitas pengguna sebelum mereka dapat mengakses sistem dikenal sebagai autentikasi. Autentikasi dapat diterapkan dalam Laravel dengan menggunakan sistem login berbasis "session". Session adalah mekanisme yang menyimpan data pengguna sementara di sisi server setelah login berhasil. Hanya pengguna tertentu yang dapat mengakses halaman yang dilindungi, seperti halaman manajemen produk, setelah sesi diidentifikasi oleh sistem.

### 9. DataTables
Plugin berbasis JavaScript bernama DataTables digunakan untuk membuat tampilan tabel lebih interaktif. Pencarian, pengurutan kolom, pagination, dan pengaturan jumlah data yang ditampilkan adalah fitur yang tersedia.  
DataTables digunakan pada halaman daftar produk dalam aplikasi inventaris toko untuk membuat pencarian dan pengelolaan data barang lebih mudah.

### 10. Bootstrap
Bootstrap adalah framework CSS yang digunakan untuk mempercepat pembuatan tampilan web yang responsif dan rapi. Dengan bantuan Bootstrap, komponen antarmuka seperti tombol, form, tabel, alert, dan modal dapat dibuat dengan lebih mudah. Dalam kasus ini, Bootstrap digunakan untuk mendukung tampilan form tambah/edit produk, tabel data, serta modal konfirmasi hapus untuk membuat antarmuka aplikasi lebih menarik dan mudah digunakan.

### 11. Inventaris Barang
Sistem inventaris barang adalah sistem yang digunakan untuk mencatat, mengelola, dan memantau data barang yang dimiliki suatu toko atau instansi. Informasi yang biasanya dikelola meliputi nama barang, kode barang, kategori, harga, stok, dan status barang.  
Melalui aplikasi inventaris berbasis web, proses pencatatan barang menjadi lebih cepat, akurat, dan mudah diakses dibandingkan pencatatan manual.

---

## B. Penjelasan Kode

### 1. Sourcecode routes/web.php
```php
<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalProduk = Product::count();
    $totalStok = Product::sum('stok');
    $stokHabis = Product::where('stok', '<=', 0)->count();
    $stokRendah = Product::where('stok', '>', 0)->where('stok', '<=', 5)->count();
    $produkTerbaru = Product::latest()->take(5)->get();
    $nilaiInventori = Product::selectRaw('SUM(harga * stok) as total')->value('total') ?? 0;

    return view('dashboard', compact(
        'totalProduk',
        'totalStok',
        'stokHabis',
        'stokRendah',
        'produkTerbaru',
        'nilaiInventori'
    ));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});
```

### Penjelasan

File web.php digunakan untuk mengatur semua route pada aplikasi. Route / digunakan untuk menampilkan halaman awal (welcome).
Route /dashboard digunakan untuk menampilkan dashboard yang berisi data statistik produk seperti total produk, total stok, stok habis, stok rendah, dan nilai inventori.
Middleware auth digunakan agar halaman dashboard hanya bisa diakses oleh user yang sudah login.
Route /profile digunakan untuk mengelola data profil user (edit, update, delete).
require auth.php digunakan untuk memanggil sistem autentikasi bawaan Laravel.
Route::resource('products', ProductController::class) digunakan untuk membuat fitur CRUD produk secara otomatis (index, create, store, edit, update, delete).

### 2. Sourcecode ProductController.php
```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
```

### Penjelasan

`ProductController` digunakan untuk mengatur semua proses **CRUD (Create, Read, Update, Delete)** pada data produk.

- **index()** → digunakan untuk menampilkan semua data produk ke halaman utama.  
- **create()** → menampilkan halaman form tambah produk.  
- **store()** → digunakan untuk menyimpan data produk ke database setelah dilakukan validasi.  
- **show()** → pada kode ini tidak digunakan dan langsung diarahkan ke halaman utama.  
- **edit()** → menampilkan form edit dengan data produk yang dipilih.  
- **update()** → digunakan untuk memperbarui data produk di database.  
- **destroy()** → digunakan untuk menghapus data produk dari database.  

Pada fungsi **store()** dan **update()**, terdapat validasi untuk memastikan:
- **nama** wajib diisi  
- **stok** tidak boleh kurang dari 0  
- **harga** harus berupa angka  

### 3. Sourcecode Product.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama',
    'deskripsi',
    'stok',
    'harga',
];
}
```

### Penjelasan

Model `Product` digunakan sebagai penghubung antara aplikasi dengan tabel produk di database menggunakan **Eloquent ORM**.

- `use HasFactory` digunakan agar model dapat memanfaatkan fitur **factory** untuk membuat data dummy.
- Properti `$fillable` digunakan untuk menentukan field yang boleh diisi secara massal (*mass assignment*), yaitu:
  - **nama**
  - **deskripsi**
  - **stok**
  - **harga**

Dengan adanya `$fillable`, Laravel dapat menyimpan data ke database dengan lebih aman dan mencegah pengisian field yang tidak diizinkan.

### 4. Sourcecode Migration (create_products_table.php)
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->text('deskripsi')->nullable();
        $table->integer('stok');
        $table->decimal('harga', 12, 2);
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```
### Penjelasan

Migration digunakan untuk membuat struktur tabel pada database secara otomatis.

Pada migration ini dibuat tabel **products** dengan beberapa kolom:
- **id** → sebagai primary key  
- **nama** → menyimpan nama produk  
- **deskripsi** → menyimpan deskripsi produk (boleh kosong)  
- **stok** → menyimpan jumlah stok produk  
- **harga** → menyimpan harga produk  
- **timestamps** → menyimpan waktu pembuatan dan update data  

Method **up()** digunakan untuk membuat tabel, sedangkan **down()** digunakan untuk menghapus tabel jika migration di-*rollback*.

### 5. Sourcecode DatabaseSeeder.php
```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Bikin 1 User buat login Pak Cik / Mas Aimar
    User::factory()->create([
        'name' => 'Mas Aimar',
        'email' => 'aimar@toko.com',
        'password' => bcrypt('password'), // password buat login nanti
    ]);

    // Bikin 10 Data Produk Otomatis
    \App\Models\Product::factory(10)->create();
}
}
```

### Penjelasan

`DatabaseSeeder` digunakan untuk mengisi data awal ke dalam database secara otomatis.

- Membuat 1 user untuk login dengan:
  - **email** : aimar@toko.com  
  - **password** : password  

- Membuat 10 data produk secara otomatis menggunakan **factory**

Dengan adanya seeder, aplikasi tidak kosong saat pertama dijalankan dan langsung bisa digunakan untuk testing.

### 6. Sourcecode ProductFactory.php
```php
<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'nama' => $this->faker->randomElement(['Serum Pak Cik', 'Aimar Glow Serum', 'Sunscreen Mas Jakobi', 'Toner Suki-Suki', 'Moisturizer Aim']),
        'deskripsi' => 'Produk skincare kualitas terbaik pilihan Mas Aimar.',
        'stok' => $this->faker->numberBetween(10, 100),
        'harga' => $this->faker->numberBetween(50000, 250000),
    ];
}
}
```

### Penjelasan

`ProductFactory` digunakan untuk membuat data dummy produk secara otomatis.

- `faker` digunakan untuk menghasilkan data acak seperti:
  - **nama produk**
  - **stok**
  - **harga**

Data yang dihasilkan menyerupai data asli sehingga cocok untuk testing aplikasi. Dengan factory, proses pengisian data menjadi lebih cepat tanpa input manual.

---

## C. Penjelasan Implementasi Sistem

Pada praktikum ini dibuat sebuah aplikasi web inventori sederhana menggunakan framework Laravel. Aplikasi ini digunakan untuk mengelola data produk pada toko Pak Cik dan Mas Aimar. Sistem memiliki fitur utama berupa CRUD (Create, Read, Update, Delete) yang memungkinkan pengguna untuk menambah, melihat, mengubah, dan menghapus data produk. Semua data disimpan di database MySQL dan dikelola menggunakan Eloquent ORM. Untuk meningkatkan keamanan, sistem dilengkapi dengan fitur login berbasis session sehingga hanya user yang sudah login yang dapat mengakses halaman produk. Selain itu, digunakan juga migration untuk membuat struktur database, serta seeder dan factory untuk mengisi data awal secara otomatis agar aplikasi dapat langsung digunakan tanpa harus input data manual. Tampilan aplikasi dibuat menggunakan Blade Template dan Bootstrap sehingga lebih rapi dan mudah digunakan.

---

## D. Hasil Tampilan 

### Halaman Awal
![Halaman Awal](assets/01-halaman-awal.png)

Halaman awal merupakan tampilan pertama saat aplikasi dijalankan. Pada halaman ini terdapat informasi singkat mengenai sistem inventori skincare Pak Cik & Aimar, serta tombol navigasi ke halaman login dan daftar akun.

---

### Halaman Registrasi
![Halaman Registrasi](assets/02-register.png)

Halaman registrasi digunakan untuk membuat akun baru agar pengguna dapat masuk ke dalam sistem. User diminta mengisi nama, email, password, dan konfirmasi password.

---

### Halaman Login
![Halaman Login](assets/03-login.png)

Halaman login digunakan untuk masuk ke dalam sistem. User harus memasukkan email dan password yang sudah terdaftar agar dapat mengakses dashboard dan fitur manajemen produk.

---

### Halaman Dashboard
![Halaman Dashboard](assets/04-dashboard.png)

Dashboard menampilkan ringkasan data inventori, seperti total produk, total stok, stok rendah, dan stok habis. Selain itu, ditampilkan juga daftar produk terbaru yang telah masuk ke dalam sistem.

---

### Halaman Daftar Produk
![Halaman Daftar Produk](assets/05-daftar-produk.png)

Halaman daftar produk menampilkan seluruh data produk dalam bentuk tabel. Informasi yang ditampilkan meliputi nama produk, deskripsi, stok, harga, dan tombol aksi untuk edit maupun hapus data.

---

### Halaman Tambah Produk
![Halaman Tambah Produk](assets/06-tambah-produk.png)

Halaman tambah produk digunakan untuk memasukkan data produk baru ke dalam database. User perlu mengisi nama produk, deskripsi, stok, dan harga sebelum data disimpan.

---

### Hasil Berhasil Menambah Produk
![Berhasil Menambah Produk](assets/07-berhasil-tambah.png)

Setelah data berhasil disimpan, sistem menampilkan notifikasi bahwa produk berhasil ditambahkan. Data yang baru dimasukkan juga langsung tampil pada daftar produk.

---

### Halaman Edit Produk
![Halaman Edit Produk](assets/08-edit-produk.png)

Halaman edit produk digunakan untuk memperbarui data produk yang sudah ada. Form ini menampilkan data lama agar dapat diubah sesuai kebutuhan.

---

### Hasil Berhasil Update Produk
![Berhasil Update Produk](assets/09-berhasil-update.png)

Setelah proses edit selesai, sistem menampilkan notifikasi bahwa data produk berhasil diperbarui.

---

### Modal Konfirmasi Hapus
![Modal Hapus Produk](assets/10-modal-hapus.png)

Sebelum data dihapus, sistem akan menampilkan modal konfirmasi terlebih dahulu. Hal ini bertujuan untuk mencegah penghapusan data secara tidak sengaja.

---

### Hasil Berhasil Hapus Produk
![Berhasil Hapus Produk](assets/11-berhasil-hapus.png)

Setelah pengguna menekan tombol hapus pada modal konfirmasi, data akan dihapus dari database dan sistem menampilkan notifikasi bahwa produk berhasil dihapus.

---

### Dropdown Profil pada Dashboard
![Dropdown Profil Dashboard](assets/12-dropdownprofile.png)

Pada bagian kanan atas dashboard terdapat menu profil yang berisi akses ke halaman profil dan tombol logout dari sistem.

---

## E. Kesimpulan

Pada praktikum modul 11, 12, dan 13 ini telah berhasil dibuat sebuah aplikasi web inventori menggunakan framework Laravel.

Aplikasi ini memiliki fitur utama berupa CRUD (Create, Read, Update, Delete) untuk mengelola data produk, serta dilengkapi dengan sistem autentikasi berbasis session sehingga hanya pengguna yang telah login yang dapat mengakses sistem.

Penggunaan Laravel dengan konsep MVC (Model, View, Controller) mempermudah dalam pengembangan aplikasi karena struktur kode menjadi lebih terorganisir dan mudah dipahami. Selain itu, penggunaan migration, seeder, dan factory membantu dalam pengelolaan database serta pengisian data awal secara otomatis.

---

## Referensi

[1] Modul Praktikum Aplikasi Berbasis Platform (ABP) Modul 11  
[2] Modul Praktikum Aplikasi Berbasis Platform (ABP) Modul 12  
[3] Modul Praktikum Aplikasi Berbasis Platform (ABP) Modul 13  
[4] Laravel Documentation. https://laravel.com/docs  
[5] W3Schools. https://www.w3schools.com  