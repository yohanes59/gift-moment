<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $souvenir = Category::where('name', 'Souvenir')->firstOrFail();
        $hantaran = Category::where('name', 'Hantaran')->firstOrFail();

        $data = [
            [
                'categories_id' => $souvenir->id,
                'name' => 'Cermin Gagang Bulat Emas',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813079/capstone-gits/KACA_OVAL_wsh5ny.jpg',
                'price' => '2000',
                'capital_price' => '1500',
                'description' => trim('
HARGA TERTERA UNTUK 1 PCS KACA OVAL
- Bahan : Kaca
- Kemasan : Plastik
- Ukuran tanpa kemasan :
    P : 15 cm , L : 6,5 cm , L : 0,5 cm
- Ukuran di kemas P x L x T : 17 x 8,5 x 1,5 cm
- 1 pack berisi 20 Kaca Gagang
- Setiap kaca sudah di bungkus plastik dan di ikat kawat emas
- Berat Produk : 20 gram/pcs
KETENTUAN ORDER:
- Minimal Order 20 pcs.
                '),
                'weight' => '20',
                'stock_amount' => 0,
                'minimum_order' => 20
            ],
            [
                'categories_id' => $souvenir->id,
                'name' => 'Gunting Kuku Kecil',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813169/capstone-gits/gunting_kuku_gpzq5e.jpg',
                'price' => '1800',
                'capital_price' => '850',
                'description' => trim('
Detail produk :
- Bahan Stainless
- Harga tertera untuk 1 pcs
- Kemasan plastic dan di ikat kawat emas
- Minimal order 20 pcs. 
- Berat produk 55 gram/pcs
                '),
                'weight' => '55',
                'stock_amount' => 0,
                'minimum_order' => 20
            ],
            [
                'categories_id' => $souvenir->id,
                'name' => 'Talenan',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813193/capstone-gits/talenan_kayu_jhtkwi.jpg',
                'price' => '3500',
                'capital_price' => '1500',
                'description' => trim('
Deskripsi :
Souvenir Talenan kayu

-Bahan Kayu
-Ukuran 12 x 24 x 1 cm
-Harga sdh termasuk sablon / cetak nama (gambar suka2)
-Kemas plastik, kartu ucapan dan pita
-Minimal order 20pcs
- Berat produk 75 gram/pcs
                '),
                'weight' => '75',
                'stock_amount' => 0,
                'minimum_order' => 20
            ],
            [
                'categories_id' => $souvenir->id,
                'name' => 'Sisir set Mika',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813288/capstone-gits/sisir-mika_zv4ved.jpg',
                'price' => '2500',
                'capital_price' => '750',
                'description' => trim('
Deskripsi
Souvenir Pernikahan Sisir
- Kemas mika motif

KETENTUAN ORDER:
- Minimal 50pcs
- Bahan sisir dari plastik
- Kemasan mika printing
- Ukuran 20cm
- Warna random atau campuran
- Berat produk 18 gram/pcs
                '),
                'weight' => '18',
                'stock_amount' => 0,
                'minimum_order' => 50
            ],
            [
                'categories_id' => $souvenir->id,
                'name' => 'Gelas',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813225/capstone-gits/gelas_kaca_lcmmlp.jpg',
                'price' => '4000',
                'capital_price' => '3000',
                'description' => trim('
Deskripsi produk :
- Ukuran 8x6cm
- Desain mengikuti kemauan customer atau mengikuti buku katalog desain
- Sablon satu tinta
- Dilengkapi bungkus plastik dan ikat kawat emas
- Bahan kaca
- Berat 120 gram

Catatan :
Semua barang sebelum packing dan pengiriman di sortir dan dicek terlebih dahulu, semua dalam keadaan baik tidak ada yang rusak dan pecah.
                '),
                'weight' => '120',
                'stock_amount' => 0,
                'minimum_order' => 20
            ],
            [
                'categories_id' => $souvenir->id,
                'name' => 'Pisau Kecil Mika',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813317/capstone-gits/pisau_buah_yva3ku.jpg',
                'price' => '3000',
                'capital_price' => '960',
                'description' => trim('
Deskripsi Produk
- pisau kecil kemasan mika motif
- setiap pisau sudah di kemas mika motif 1/1
- warna tangkai pisau sudah warna warni dan tidak bisa regues warna
- bahan pisau dari besi stenlisteel gagang nya dari bahan p[lastik
- ukuran panjang pisau 15cm
- setiap pisau sudah dikemas mika satu persatu

KETENTUAN ORDER:
- Harga tertera untuk 1 pcs
- Minimal order 50 pcs
- Warna Gagang pisau mikanya akan di kirimkan secara random mengikuti stok yang tersedia
- Berat produk 15gram
                '),
                'weight' => '15',
                'stock_amount' => 0,
                'minimum_order' => 50
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Cutting Acrylic Premium Flower 30x45cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813527/capstone-gits/Premium_Flower_kq6py2.jpg',
                'price' => '480000',
                'capital_price' => '350000',
                'description' => trim('
Cutting Acrylic Premium Flower 30x45. Format Tulisan:
(TULIS DI PESAN NOTES SAAT CHECKOUT)
- Nama pasangan
- Tanggal
- Tulisan ayat / kata kata lainnya
- (The Wedding Of) otomatis ditulis sesuai foto produk)
CONTOH :
Kholis & Nina 13 Februari 2023
Ayat Ar Rum 21 Bahasa Indonesia

SUDAH TERMASUK:
- Uang Kertas Mainan maksimal 20 gulung, karena space terbatas.
- Bingkai ukuran luar 30x45cm dgn Kaca Akrilik, jadi lebih aman saat pengiriman.
- Dekor Bunga Kain 
- Berat produk 2 kg

KELEBIHAN:
- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.
- Terdapat gantungan bingkai untuk digantung.
MENGGUNAKAN BUNGA PALSU BAHAN KAIN & BUNGA KERING ASLI, JADI AWET & EVERLASTING.
                '),
                'weight' => '2000',
                'stock_amount' => 0,
                'minimum_order' => 0
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Gift Wedding Jam 25x35cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813526/capstone-gits/Gift_Wedding_Jam_epr0dx.jpg',
                'price' => '150000',
                'capital_price' => '100000',
                'description' => trim('
Gift Wedding Jam 25x35cm
Format Tulisan:
(TULIS DI PESAN NOTES SAAT CHECKOUT) 
- Nama pasangan
- Tanggal
- Jam
- Tulisan ayat / kata kata lainnya
- Foto Pasangan
- Bouquet kecil
- Hiasan kupu-kupu
(Happy Wedding) otomatis ditulis sesuai foto produk)
CONTOH :
Ghoji & Mahda 27.04.2023
Ayat Ar Rum 21 Bahasa Indonesia

SUDAH TERMASUK:
- Bingkai ukuran luar 25x35cm dgn Kaca Akrilik, jadi lebih aman saat pengiriman.
- Berat Produk 1,5kg

KELEBIHAN:
- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.
- Terdapat gantungan bingkai untuk digantung.
                '),
                'weight' => '1500',
                'stock_amount' => 0,
                'minimum_order' => 0
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Cutting Acrylic 20x30cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813527/capstone-gits/Cutting_Acrylic_20x30_uhwyj2.jpg',
                'price' => '300000',
                'capital_price' => '220000',
                'description' => trim('
Cutting Acrylic 20x30cm
Format Tulisan:
(TULIS DI PESAN NOTES SAAT CHECKOUT)
- Nama pasangan
- Tanggal

CONTOH :
Aryo & Irna 24 Mei 2023

SUDAH TERMASUK:
-Uang Kertas Mainan maksimal 10 lembar, karena space terbatas.
- Bingkai ukuran luar 20x30cm dgn Kaca Akrilik, jadi lebih aman saat pengiriman.
- Dekor Bunga Kain 
- Uang koin 1.000 jadul 
- Variasi buku nikah 
- Berat Produk 1kg

KELEBIHAN:
- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.
- Terdapat gantungan bingkai untuk digantung.
- Menggunakan bunga palsu bahan kain jadi Awet & Everlasting.
                '),
                'weight' => '1000',
                'stock_amount' => 0,
                'minimum_order' => 0
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Cuttingg Acrylic 25x35cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813527/capstone-gits/Cuttingg_Acrylic_25x35cm_nkbsgo.jpg',
                'price' => '350000',
                'capital_price' => '300000',
                'description' => trim('
Cutting Acrylic 25x35cm
Format Tulisan:
(TULIS DI PESAN NOTES SAAT CHECKOUT)
- Nama pasangan
- Tanggal

CONTOH :
Riyanti & Lisa 15 Maret 2023

SUDAH TERMASUK:
- Uang Kertas Mainan maksimal 10 gulung, karena space terbatas.
- Bingkai ukuran luar 25x35cm dgn Kaca Akrilik, jadi lebih aman saat pengiriman.
- Dekor Bunga Kain 
- Variasi buku nikah 
- Berat produk 3kg

KELEBIHAN:
- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.
- Terdapat gantungan bingkai untuk digantung.
- Menggunakan bunga palsu bahan kain jadi Awet & Everlasting.
                '),
                'weight' => '3000',
                'stock_amount' => 0,
                'minimum_order' => 0
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Cutting Acrylic 25x35cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813527/capstone-gits/Cutting_Acrylic_25x35cm_egww08.jpg',
                'price' => '320000',
                'capital_price' => '250000',
                'description' => trim('
Cutting Acrylic 25x35cm
Format Tulisan:
(TULIS DI PESAN NOTES SAAT CHECKOUT)
- Nama pasangan
- Tanggal

CONTOH :
Rizki & Cicik 18 Januari 2023
(Bismillah) otomatis ditulis sesuai foto produk)

SUDAH TERMASUK:
- Uang Kertas Mainan maksimal 10 gulung, karena space terbatas.
- Bingkai ukuran luar 25x35cm dgn Kaca Akrilik, jadi lebih aman saat pengiriman.
- Dekor Bunga Kain 
- Berat produk 2kg

KELEBIHAN:
- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.
- Terdapat gantungan bingkai untuk digantung.
- Menggunakan bunga palsu bahan kain jadi Awet & Everlasting.
                '),
                'weight' => '2000',
                'stock_amount' => 0,
                'minimum_order' => 0
            ],
        ];

        $client = new Client();

        foreach ($data as $item) {
            $response = $client->request('GET', $item['image']);
            $extension = pathinfo($item['image'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            Storage::put('public/assets/product/' . $imageName, $response->getBody());

            Product::insert([
                'id' => Str::uuid(),
                'categories_id' => $item['categories_id'],
                'name' => $item['name'],
                'image' => 'assets/product/' . $imageName,
                'price' => $item['price'],
                'capital_price' => $item['capital_price'],
                'description' => $item['description'],
                'weight' => $item['weight'],
                'stock_amount' => $item['stock_amount'],
                'minimum_order' => $item['minimum_order'],
                'slug' => $item['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
