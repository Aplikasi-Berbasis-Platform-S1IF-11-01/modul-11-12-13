<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * ProductFactory
 *
 * Factory untuk menghasilkan data produk dummy yang realistis.
 * Menggunakan data produk-produk yang biasa ada di toko kelontong Indonesia.
 *
 * Cara penggunaan:
 * - Product::factory()->create()           // buat 1 produk
 * - Product::factory()->count(30)->create() // buat 30 produk
 * - Product::factory()->lowStock()->create() // produk dengan stok menipis
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Daftar produk toko berdasarkan kategori.
     * Ini biar data dummy-nya lebih realistis dan relevan dengan toko Indonesia.
     */
    private array $productData = [
        'Makanan' => [
            'Indomie Goreng', 'Indomie Kuah', 'Mie Sedaap', 'Pop Mie',
            'Biscuit Roma', 'Wafer Tango', 'Keripik Singkong', 'Chiki Balls',
            'Snack Qtela', 'Biskuat', 'Oreo', 'Roti Tawar Sari Roti',
            'Roti Gandum', 'Kacang Atom', 'Coklat Kit Kat',
        ],
        'Minuman' => [
            'Aqua 600ml', 'Aqua 1.5L', 'Teh Botol Sosro', 'Frestea',
            'Sprite 500ml', 'Coca Cola 500ml', 'Fanta Merah', 'Mizone',
            'Pocari Sweat', 'Goodday Cappuccino', 'Kopi Kapal Api',
            'Susu Ultra UHT', 'Susu Frisian Flag', 'Nu Green Tea', 'Extra Joss',
        ],
        'Kebersihan' => [
            'Sabun Lifebuoy', 'Shampoo Pantene', 'Pasta Gigi Pepsodent',
            'Detergen Rinso', 'Softener Molto', 'Sabun Cuci Piring Sunlight',
            'Tisu Paseo', 'Pembalut Charm', 'Odol Sensodyne',
        ],
        'Sembako' => [
            'Beras Premium 5kg', 'Gula Pasir 1kg', 'Minyak Goreng Bimoli',
            'Tepung Terigu Segitiga', 'Garam Refina', 'Kecap Bango',
            'Saus Sambal ABC', 'Saos Tomat', 'Royco Bumbu Ayam',
        ],
        'Peralatan' => [
            'Baterai ABC AA', 'Baterai ABC AAA', 'Lampu LED Philips',
            'Kantong Plastik', 'Korek Api', 'Sedotan', 'Spons Cuci',
        ],
    ];

    /**
     * Definisi state default untuk factory.
     * Setiap kali factory dipanggil, akan menggunakan konfigurasi ini.
     */
    public function definition(): array
    {
        // Pilih kategori secara acak
        $category = $this->faker->randomElement(array_keys($this->productData));

        // Pilih nama produk dari kategori yang terpilih
        $name = $this->faker->randomElement($this->productData[$category]);

        // Buat harga yang realistis berdasarkan kategori
        $priceRanges = [
            'Makanan'    => [1500, 25000],
            'Minuman'    => [3000, 20000],
            'Kebersihan' => [5000, 35000],
            'Sembako'    => [3000, 75000],
            'Peralatan'  => [1000, 50000],
        ];

        [$minPrice, $maxPrice] = $priceRanges[$category];

        // Harga dalam kelipatan 500
        $price = round($this->faker->numberBetween($minPrice, $maxPrice) / 500) * 500;

        return [
            'name'        => $name,
            'category'    => $category,
            'price'       => $price,
            'stock'       => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->optional(0.7)->sentence(8), // 70% punya deskripsi
        ];
    }

    /**
     * State untuk produk dengan stok menipis (0-9).
     * Gunakan: Product::factory()->lowStock()->create()
     */
    public function lowStock(): static
    {
        return $this->state(fn () => [
            'stock' => $this->faker->numberBetween(0, 9),
        ]);
    }

    /**
     * State untuk produk dengan stok banyak (50+).
     * Gunakan: Product::factory()->highStock()->create()
     */
    public function highStock(): static
    {
        return $this->state(fn () => [
            'stock' => $this->faker->numberBetween(50, 200),
        ]);
    }

    /**
     * State untuk produk habis.
     * Gunakan: Product::factory()->outOfStock()->create()
     */
    public function outOfStock(): static
    {
        return $this->state(fn () => [
            'stock' => 0,
        ]);
    }
}