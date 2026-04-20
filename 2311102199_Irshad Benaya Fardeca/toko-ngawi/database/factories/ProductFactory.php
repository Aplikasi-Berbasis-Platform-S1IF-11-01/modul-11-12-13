<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    // Data produk nyata per kategori
    private array $productData = [
        'Sembako' => [
            ['name' => 'Beras Pandan Wangi 5kg', 'unit' => 'karung', 'min' => 65000, 'max' => 75000],
            ['name' => 'Beras Rojolele 5kg', 'unit' => 'karung', 'min' => 60000, 'max' => 70000],
            ['name' => 'Gula Pasir 1kg', 'unit' => 'kg', 'min' => 13000, 'max' => 16000],
            ['name' => 'Minyak Goreng Tropical 2L', 'unit' => 'botol', 'min' => 28000, 'max' => 35000],
            ['name' => 'Tepung Terigu Cakra 1kg', 'unit' => 'kg', 'min' => 12000, 'max' => 15000],
            ['name' => 'Garam Dapur 500g', 'unit' => 'bungkus', 'min' => 3000, 'max' => 5000],
            ['name' => 'Telur Ayam 1kg', 'unit' => 'kg', 'min' => 25000, 'max' => 30000],
        ],
        'Minuman' => [
            ['name' => 'Indomilk Full Cream 1L', 'unit' => 'kotak', 'min' => 18000, 'max' => 22000],
            ['name' => 'Teh Botol Sosro 450ml', 'unit' => 'botol', 'min' => 5000, 'max' => 7000],
            ['name' => 'Aqua 600ml', 'unit' => 'botol', 'min' => 3000, 'max' => 4500],
            ['name' => 'Aqua Galon 19L', 'unit' => 'galon', 'min' => 18000, 'max' => 22000],
            ['name' => 'Kopi Kapal Api 165g', 'unit' => 'bungkus', 'min' => 12000, 'max' => 16000],
            ['name' => 'Sprite 1.5L', 'unit' => 'botol', 'min' => 9000, 'max' => 12000],
            ['name' => 'Pocari Sweat 500ml', 'unit' => 'botol', 'min' => 8000, 'max' => 10000],
        ],
        'Mie & Snack' => [
            ['name' => 'Indomie Goreng (Renceng)', 'unit' => 'renceng', 'min' => 25000, 'max' => 30000],
            ['name' => 'Mie Sedaap Soto', 'unit' => 'pcs', 'min' => 3000, 'max' => 4000],
            ['name' => 'Chitato Sapi Panggang 68g', 'unit' => 'bungkus', 'min' => 12000, 'max' => 15000],
            ['name' => 'Oreo Vanilla 137g', 'unit' => 'bungkus', 'min' => 15000, 'max' => 18000],
            ['name' => 'Roma Marie Susu 200g', 'unit' => 'bungkus', 'min' => 9000, 'max' => 12000],
        ],
        'Bumbu Dapur' => [
            ['name' => 'Royco Ayam 460g', 'unit' => 'bungkus', 'min' => 15000, 'max' => 18000],
            ['name' => 'Kecap Manis ABC 275ml', 'unit' => 'botol', 'min' => 8000, 'max' => 12000],
            ['name' => 'Saos Tomat Del Monte 330g', 'unit' => 'botol', 'min' => 12000, 'max' => 15000],
            ['name' => 'Bawang Merah 250g', 'unit' => 'bungkus', 'min' => 8000, 'max' => 14000],
            ['name' => 'Cabai Rawit Merah 100g', 'unit' => 'bungkus', 'min' => 5000, 'max' => 15000],
        ],
        'Kebersihan' => [
            ['name' => 'Rinso Anti Noda 900g', 'unit' => 'bungkus', 'min' => 18000, 'max' => 22000],
            ['name' => 'Sabun Lifebuoy 85g', 'unit' => 'pcs', 'min' => 5000, 'max' => 7000],
            ['name' => 'Pepsodent Herbal 190g', 'unit' => 'pcs', 'min' => 12000, 'max' => 16000],
            ['name' => 'Sunlight Jeruk Nipis 800ml', 'unit' => 'botol', 'min' => 15000, 'max' => 18000],
            ['name' => 'Wipol Karbol 800ml', 'unit' => 'botol', 'min' => 12000, 'max' => 15000],
        ],
        'Rokok' => [
            ['name' => 'Gudang Garam Merah 12', 'unit' => 'bungkus', 'min' => 20000, 'max' => 25000],
            ['name' => 'Dji Sam Soe 12', 'unit' => 'bungkus', 'min' => 25000, 'max' => 30000],
            ['name' => 'Surya 16', 'unit' => 'bungkus', 'min' => 30000, 'max' => 35000],
        ],
    ];

    public function definition(): array
    {
        // Pilih kategori random
        $category = $this->faker->randomKey($this->productData);
        // Pilih produk random dari kategori
        $product  = $this->faker->randomElement($this->productData[$category]);

        return [
            'name'        => $product['name'],
            'category'    => $category,
            'price'       => $this->faker->numberBetween($product['min'], $product['max']),
            'stock'       => $this->faker->numberBetween(0, 200),
            'unit'        => $product['unit'],
            'description' => $this->faker->optional(0.6)->sentence(8),
        ];
    }

    /**
     * State: stok menipis
     */
    public function lowStock(): static
    {
        return $this->state(['stock' => $this->faker->numberBetween(1, 9)]);
    }

    /**
     * State: stok habis
     */
    public function outOfStock(): static
    {
        return $this->state(['stock' => 0]);
    }
}