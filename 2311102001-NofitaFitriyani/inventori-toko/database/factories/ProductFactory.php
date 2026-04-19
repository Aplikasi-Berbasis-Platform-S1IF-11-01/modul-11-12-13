<?php

// Watermark: 2311102001-NofitaFitriyani

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Minuman', 'Makanan Ringan', 'Kebutuhan Rumah', 'Produk Susu',
            'Produk Beku', 'Bumbu & Rempah', 'Mie & Pasta', 'Perawatan Diri',
            'Pembersih Rumah', 'Rokok & Tembakau',
        ];

        $products = [
            'Minuman' => ['Aqua Galon 19L', 'Teh Botol Sosro', 'Pocari Sweat 500ml', 'Le Minerale 1500ml', 'Coca Cola 1.5L', 'Sprite 390ml', 'Fanta Strawberry 390ml', 'Nu Tea 330ml', 'Mizone Lychee 500ml', 'Good Day Cappuccino'],
            'Makanan Ringan' => ['Indomie Goreng', 'Pringles Original 110g', 'Oreo Original', 'Chitato Sapi Panggang', 'Taro Net 80g', 'Nabati Wafer', 'Richeese Fire Chicken', 'Biscoff 250g', 'Superstar Keripik', 'Lays Classic 68g'],
            'Kebutuhan Rumah' => ['Tisu Paseo 250 sheet', 'Soklin Softergent 1kg', 'Sunlight Lemon 800ml', 'Rinso Anti Noda 900g', 'Sabun Ekonomi 75g', 'Mama Lemon 800ml', 'Tisu Basah 50 lembar', 'Kantong Plastik Kresek', 'Kain Lap Microfiber', 'Pembersih Lantai Wipol'],
            'Produk Susu' => ['Indomilk Full Cream 1L', 'Ultramilk 200ml', 'Dancow 1+ 400g', 'Milo 1kg', 'Frisian Flag Putih 1L', 'Susu Kental Manis Bendera', 'SGM Bunda 400g', 'Bear Brand 140ml', 'Cimory UHT 250ml', 'Ensure 400g'],
            'Produk Beku' => ['Sosis So Good 500g', 'Nugget So Good 500g', 'Es Krim Walls Cornetto', 'Fiesta Chicken Wing', 'Cedea Bakso Ikan 500g', 'Kapal Api Dimsum', 'Baso Aci Ready 400g', 'Tuna Kaleng ABC', 'Sardin Abc', 'Ekado Udang 10pcs'],
            'Bumbu & Rempah' => ['Kecap Bango 600ml', 'Saos Sambal ABC 340ml', 'Royco Ayam 250g', 'Sasa Penyedap 250g', 'Kokita Bumbu Rendang', 'Garam Kapal 500g', 'Gula Pasir Rose Brand 1kg', 'Minyak Goreng Bimoli 2L', 'Tepung Terigu Segitiga 1kg', 'Merica Lada Putih 50g'],
            'Mie & Pasta' => ['Indomie Kuah Soto', 'Mie Sedaap Goreng', 'Supermi Ayam Bawang', 'Sarimi Isi 2 Soto', 'Pop Mie Ayam', 'Lemonilo Kuah', 'Bihun Jagung Rose Brand', 'Spagetti Finna 500g', 'Pasta ABC Bolognese', 'Bakmi Mewah Classic'],
            'Perawatan Diri' => ['Lifebuoy Sabun 100g', 'Pantene Shampoo 200ml', 'Gatsby Hair Pomade', 'Dove Body Lotion 200ml', 'Pepsodent 190g', 'Rexona Deodorant 45ml', 'Vaseline Intensive Care 100ml', 'Biore UV Aqua Rich SPF50', 'Wardah Sunscreen SPF30', 'Ciptadent Toothbrush'],
            'Pembersih Rumah' => ['Baygon Semprot 600ml', 'Hit Aerosol 675ml', 'Wipol Karbol 800ml', 'Super Pell Lantai 800ml', 'Dettol 450ml', 'Ajax Pembersih Kamar Mandi', 'Vixal Biru 800ml', 'Domestos Nomos 750ml', 'Rinso Cair 1L', 'Soklin Lantai 900ml'],
            'Rokok & Tembakau' => ['Sampoerna A Mild 12s', 'Gudang Garam Merah 12s', 'Djarum Super 12s', 'Lucky Strike 20s', 'Apache Biru 12s', 'Class Mild 16s', 'L.A. Light 16s', 'Magnum Filter 12s', 'Dunhill Mild 20s', 'GG International 20s'],
        ];

        $category = $this->faker->randomElement($categories);
        $productList = $products[$category];
        $name = $this->faker->randomElement($productList);
        $buyingPrice = $this->faker->numberBetween(2000, 150000);
        $price = $buyingPrice * $this->faker->randomFloat(2, 1.1, 1.4);

        return [
            'name'         => $name,
            'price'        => round($price / 100) * 100,
            'buying_price' => $buyingPrice,
            'stock'        => $this->faker->numberBetween(0, 200),
            'unit'         => $this->faker->randomElement(['pcs', 'dus', 'botol', 'kg', 'liter', 'pack', 'lusin']),
            'description'  => $this->faker->sentence(10),
            'image'        => null,
        ];
    }
}
