<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static int $skuCounter = 1;

    public function definition(): array
    {
        $catalog = [
            'Sembako' => [
                ['Beras Pandan Wangi 5kg', 'Beras premium pulen wangi khas Cianjur'],
                ['Beras IR64 10kg', 'Beras putih ekonomis cocok untuk keluarga besar'],
                ['Gula Pasir Curah 1kg', 'Gula putih halus untuk masak dan minuman'],
                ['Gula Merah Jawa 500g', 'Gula aren asli dari Jawa Tengah'],
                ['Minyak Goreng Tropical 2L', 'Minyak goreng kelapa sawit jernih'],
                ['Minyak Goreng Bimoli 1L', 'Minyak goreng satu liter fortifikasi vitamin'],
                ['Tepung Terigu Segitiga Biru 1kg', 'Tepung protein sedang serbaguna'],
                ['Tepung Beras Rose Brand 500g', 'Tepung beras halus untuk kue tradisional'],
                ['Garam Dapur Refina 250g', 'Garam beryodium untuk masak sehari-hari'],
                ['Kecap Manis ABC 135ml', 'Kecap manis kental untuk masakan nusantara'],
                ['Kecap Asin Bangau 135ml', 'Kecap asin untuk tumisan dan saus'],
                ['Saos Tomat Del Monte 340g', 'Saos tomat botol untuk pizza dan pasta'],
                ['Sarden ABC Kaleng 155g', 'Ikan sarden saus tomat siap makan'],
                ['Corned Beef Pronas 198g', 'Daging sapi kalengan olahan bergizi'],
                ['Santan Kara 65ml', 'Santan instan kemasan sachet untuk masak'],
            ],

            'Minuman & Jajanan' => [
                ['Teh Celup Sariwangi 25s', 'Teh hitam celup aroma segar khas'],
                ['Kopi Kapal Api Spesial 165g', 'Kopi bubuk robusta pilihan tanpa ampas'],
                ['Kopi Nescafe Classic 100g', 'Kopi instan murni tanpa gula'],
                ['Susu Kental Manis Indomilk 380g', 'Susu kental manis serbaguna'],
                ['Susu Bear Brand 189ml', 'Susu steril kaleng tanpa lemak tambahan'],
                ['Milo Sachet 30g', 'Minuman coklat malt berenergi'],
                ['Ovomaltine Sachet 30g', 'Minuman malt coklat kaya vitamin'],
                ['Pop Ice Coklat 25g', 'Minuman serbuk rasa coklat es blender'],
                ['Nutrisari Jeruk Sachet 14g', 'Minuman serbuk vitamin C rasa jeruk'],
                ['Aqua Galon 19L', 'Air mineral galon isi ulang pabrik'],
                ['Teh Botol Sosro 230ml', 'Teh manis botol kaca siap minum'],
                ['Pocari Sweat 500ml', 'Minuman isotonik pengganti ion tubuh'],
                ['Bir Bintang 330ml', 'Minuman malt non-alkohol menyegarkan'],
                ['Good Day Cappuccino 250ml', 'Kopi susu botol siap minum'],
                ['Wafer Tango Coklat 176g', 'Wafer berlapis coklat renyah'],
                ['Biskuit Roma Kelapa 115g', 'Biskuit gurih rasa kelapa'],
                ['Permen Kopiko Kopi 150g', 'Permen keras rasa kopi klasik'],
                ['Chiki Cheese 68g', 'Snack jagung rasa keju anak-anak'],
                ['Cheetos Jagung Bakar 68g', 'Snack ringan rasa jagung bakar'],
            ],

            'Bumbu & Rempah' => [
                ['Royco Ayam Sachet 8g', 'Penyedap rasa kaldu ayam instan'],
                ['Masako Sapi 8g', 'Bumbu penyedap kaldu sapi pilihan'],
                ['Knorr Sayur Sachet 8g', 'Penyedap rasa sayuran alami'],
                ['Sasa Vetsin 50g', 'MSG penyedap masakan serbaguna'],
                ['Terasi Udang Indofood 50g', 'Terasi udang asli fermentasi khas'],
                ['Kemiri Bubuk 50g', 'Kemiri halus untuk bumbu rendang dan gulai'],
                ['Ketumbar Bubuk Ladaku 30g', 'Ketumbar giling halus kaya aroma'],
                ['Kunyit Bubuk Bamboe 25g', 'Kunyit kering giling untuk kari'],
                ['Bumbu Rendang Bamboe 75g', 'Bumbu rendang lengkap siap pakai'],
                ['Bumbu Soto Bambu 65g', 'Bumbu soto ayam jawa autentik'],
                ['Bumbu Nasi Goreng Indofood 45g', 'Bumbu nasi goreng spesial siap saji'],
                ['Cabe Bubuk Ekstra Pedas 50g', 'Cabai merah kering giling super pedas'],
                ['Lada Hitam Bubuk 30g', 'Lada hitam halus untuk steak dan sup'],
            ],

            'Kebersihan Rumah' => [
                ['Rinso Bubuk Anti Noda 1kg', 'Deterjen bubuk ampuh untuk noda membandel'],
                ['Soklin Softener Violet 900ml', 'Pelembut pakaian aroma violet tahan lama'],
                ['Sunlight Jeruk 800ml', 'Sabun cuci piring jeruk pembersih lemak'],
                ['Wipol Karbol Cemara 780ml', 'Karbol desinfektan lantai wangi cemara'],
                ['Baygon Semprot 600ml', 'Obat nyamuk semprot cepat ampuh'],
                ['Hit Obat Nyamuk Bakar 10pcs', 'Obat nyamuk bakar spiral 8 jam aktif'],
                ['Kapur Barus Kamper 100g', 'Pewangi pakaian dan penolak ngengat'],
                ['Sitrun Penghilang Kerak 500ml', 'Pembersih kerak kamar mandi dan bak'],
                ['Super Pell Lantai 800ml', 'Pembersih lantai wangi kilap'],
                ['Tisu Toilet Passeo 4 Roll', 'Tisu toilet lembut 2 lapis 4 roll'],
                ['Sabun Colek Ekonomi 250g', 'Sabun cuci colek serbaguna ekonomis'],
            ],

            'Perawatan Diri' => [
                ['Sabun Lifebuoy Merah 110g', 'Sabun antibakteri perlindungan 100%'],
                ['Sabun Lux Soft Rose 110g', 'Sabun mandi lembut aroma bunga mawar'],
                ['Shampo Pantene 170ml', 'Sampo perawatan rambut rontok'],
                ['Shampo Clear Anti Ketombe 170ml', 'Sampo anti ketombe ampuh'],
                ['Pasta Gigi Pepsodent 190g', 'Pasta gigi fluor perlindungan gigi'],
                ['Pasta Gigi Sensodyne 100g', 'Pasta gigi khusus gigi sensitif'],
                ['Sikat Gigi Oral-B Soft', 'Sikat gigi bulu lembut perlindungan gusi'],
                ['Deodorant Rexona Roll-on 50ml', 'Deodorant anti keringat 48 jam'],
                ['Bedak Viva Putih 60g', 'Bedak padat untuk kulit wajah cerah'],
                ['Minyak Kayu Putih Cap Lang 60ml', 'Minyak kayu putih pereda masuk angin'],
                ['Krim Tangan Citra Sakura 80ml', 'Pelembap tangan aroma sakura Jepang'],
                ['Pembalut Charm Regular 8pcs', 'Pembalut tipis penyerap cepat'],
                ['Kapas Paseo 50g', 'Kapas bulat bersih untuk kecantikan'],
            ],

            'Warung & Dapur' => [
                ['Kantong Plastik Kresek Putih 50pcs', 'Kantong belanja serbaguna ukuran sedang'],
                ['Kantong Plastik Hitam 30pcs', 'Kantong sampah tebal hitam'],
                ['Korek Api Gas Bic', 'Korek api gas isi ulang tahan lama'],
                ['Korek Api Kayu 1 Pak', 'Korek kayu satu kotak isi 40 batang'],
                ['Lilin Lebah 2 Batang', 'Lilin putih darurat tahan 6 jam'],
                ['Plastik Wrap Cling 30m', 'Plastik pembungkus makanan transparan'],
                ['Kertas Minyak 50 Lembar', 'Kertas minyak untuk gorengan dan kue'],
                ['Sumpit Kayu 10 Pasang', 'Sumpit kayu sekali pakai higenis'],
                ['Sedotan Kertas 20pcs', 'Sedotan ramah lingkungan berbahan kertas'],
                ['Tusuk Sate 100pcs', 'Tusukan bambu untuk sate dan kue'],
                ['Tali Rafia Warna Warni', 'Tali plastik gulung serbaguna'],
                ['Bungkus Nasi Daun Pisang Tiruan', 'Pembungkus nasi motif daun pisang'],
            ],

            'Obat & Suplemen' => [
                ['Paramex Sakit Kepala 4 Tab', 'Obat sakit kepala dan demam ringan'],
                ['Panadol Biru 500mg 10 Tab', 'Tablet pereda nyeri dan penurun demam'],
                ['Bodrex Flu Batuk 4 Tab', 'Obat flu batuk pilek kombinasi'],
                ['OBH Combi Batuk 100ml', 'Sirup obat batuk berdahak'],
                ['Antasida Doen Maag 10 Tab', 'Obat maag pereda nyeri lambung'],
                ['Promag Cair Sachet 15ml', 'Obat maag cair kerja cepat'],
                ['Tolak Angin Sido Muncul 15ml', 'Jamu herbal pereda masuk angin'],
                ['Tolak Angin Anak 5ml', 'Tolak angin herbal khusus anak-anak'],
                ['Betadine Antiseptik 30ml', 'Antiseptik luka merah yodium'],
                ['Counterpain Cool 30g', 'Balsem krim pereda nyeri otot'],
                ['Minyak Angin Cap Kapak 10ml', 'Minyak angin aromaterapi pereda mual'],
                ['Vitamin C Redoxon 10 Tab', 'Suplemen vitamin C 1000mg efervesen'],
                ['Multivitamin Fatigon 10 Kapsul', 'Suplemen energi multivitamin lengkap'],
                ['Oralit 200ml Sachet', 'Larutan oralit pengganti cairan diare'],
                ['Plester Tensoplast Kotak', 'Plester luka penutup beragam ukuran'],
            ],
        ];

        $category = $this->faker->randomElement(array_keys($catalog));
        [$name, $description] = $this->faker->randomElement($catalog[$category]);

        // Sedikit variasi nama agar tidak monoton
        $suffix = $this->faker->optional(0.25)->randomElement(['(Promo)', '- Hemat', '(Stok Lama)', 'Spesial', '2 Pcs']);
        $name   = $suffix ? "$name $suffix" : $name;

        // Harga realistis per kategori
        $priceRange = match ($category) {
            'Sembako'           => [3000,  95000],
            'Minuman & Jajanan' => [1500,  45000],
            'Bumbu & Rempah'    => [2000,  35000],
            'Kebersihan Rumah'  => [4000,  75000],
            'Perawatan Diri'    => [3000,  80000],
            'Warung & Dapur'    => [1000,  25000],
            'Obat & Suplemen'   => [5000, 120000],
            default             => [1000,  50000],
        };

        // Harga dibulatkan ke kelipatan 500
        $price = round($this->faker->numberBetween($priceRange[0], $priceRange[1]) / 500) * 500;

        return [
            'name'        => $name,
            'description' => $description,
            'price'       => $price,
            'stock'       => $this->faker->numberBetween(0, 150),
            'category'    => $category,
            'sku'         => 'SKU-' . str_pad(self::$skuCounter++, 5, '0', STR_PAD_LEFT),
        ];
    }
}