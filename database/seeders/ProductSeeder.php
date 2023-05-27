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
<p>HARGA TERTERA UNTUK 1 PCS KACA OVAL</p>
<p>- Bahan : Kaca</p>
<p>- Kemasan : Plastik</p>
<p>- Ukuran tanpa kemasan :</p>
<p>  P : 15 cm , L : 6,5 cm , L : 0,5 cm</p>
<p>- Ukuran di kemas P x L x T : 17 x 8,5 x 1,5 cm</p>
<p>- 1 pack berisi 20 Kaca Gagang</p>
<p>- Setiap kaca sudah di bungkus plastik dan di ikat kawat emas</p>
<p>- Berat Produk : 20 gram/pcs</p>
<p>&nbsp</p>
<p>KETENTUAN ORDER :</p>
<p>- Minimal Order 20 pcs.</p>
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
<p>HARGA TERTERA UNTUK 1 PCS GUNTING KUKU KECIL</p>
<p>- Bahan : Stainless</p>
<p>- Kemasan : Plastik dan di ikat kawat emas</p>
<p>- Berat produk : 55 gram/pcs</p>
<p>&nbsp</p>
<p>KETENTUAN ORDER:</p>
<p>- Minimal Order 20 pcs.</p>
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
<p>HARGA TERTERA UNTUK 1 PCS TALENAN</p>
<p>- Bahan : Kayu</p>
<p>- Kemasan : Plastik, Kartu ucapan dan Pita</p>
<p>- Ukuran di kemas P x L x T : 12 x 24 x 1 cm</p> 
<p>- Berat produk : 75 gram/pcs</p>
<p>&nbsp</p>
<p>KETENTUAN ORDER :</p>
<p>- Minimal Order 20 pcs.</p>
<p>&nbsp</p>
<p>Catatan :
<p>Harga sudah termasuk sablon,cetak nama dan custom gambar.
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
<p>HARGA TERTERA UNTUK 1 PCS SISIR SET MIKA</p>
<p>- Bahan : plastik</p>
<p>- Kemasan : Mika printing</p>
<p>- Ukuran : 20 cm</p>
<p>- Berat produk : 18 gram/pcs</p>
<p>&nbsp</p>
<p>KETENTUAN ORDER :</p>
<p>- Minimal Order 50 pcs.</p>
<p>&nbsp</p>
<p>Catatan :</p>
<p>Untuk warna bisa request satu warna atau campuran.</p>
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
<p>HARGA TERTERA UNTUK 1 GELAS</p>
<p>- Bahan : Kaca</p>
<p>- Kemasan : Plastik dan ikat kawat emas</p>
<p>- Ukuran : 8x6cm</p>
<p>- Berat : 120 gram</p>
<p>- Sablon : Satu tinta</p>
<p>&nbsp</p>
<p>Catatan :</p>
<p>- Semua barang sebelum packing dan pengiriman di sortir dan dicek terlebih dahulu, semua dalam keadaan baik tidak ada yang rusak dan pecah.</p>
<p>- Desain bisa custom atau mengikuti buku katalog desain.</p>
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
<p>HARGA TERTERA UNTUK 1 PISAU KECIL MIKA</p>
<p>- Bahan : besi stenlisteel</p>
<p>- Kemasan : Mika motif</p>
<p>- Ukuran : 15 cm</p>
<p>- Berat produk : 15 gram</p>
<p>&nbsp</p>
<p>KETENTUAN ORDER :</p>
<p>- Minimal Order 50 pcs.</p>
<p>&nbsp</p>
<p>Catatan :</p>
<p>- warna tangkai pisau sudah warna warni dan tidak bisa request warna</p>
<p>- setiap pisau sudah dikemas mika satu persatu</p>
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
<p>HARGA TERTERA UNTUK Cutting Acrylic Premium Flower</p> 
<p>- Ukuran luar : 30x45cm</p>
<p>- Berat : 2 kg</p>
<p>&nbsp</p>
<p>Format Tulisan :</p>
<p>(TULIS DI NOTES SAAT CHECKOUT)</p>
<p>- Nama pasangan</p>
<p>- Tanggal</p>
<p>- Tulisan ayat / kata kata lainnya</p>
<p>- The Wedding Of (otomatis ditulis sesuai foto produk)</p>
<p>CONTOH :</p>
<p>Kholis & Nina 13 Februari 2023, Ayat Ar Rum 21 Bahasa Indonesia</p>
<p>&nbsp</p>
<p>SUDAH TERMASUK :</p>
<p>- Uang Kertas Mainan maksimal 20 gulung, karena space terbatas.</p>
<p>- Bingkai dengan Kaca Akrilik, jadi lebih aman saat pengiriman.</p>
<p>- Dekor Bunga Kain</p>
<p>&nbsp</p>
<p>KELEBIHAN :</p>
<p>- Bingkai mudah dibuka, bukaan di sisi belakang.</p>
<p>- Terdapat gantungan bingkai untuk digantung.</p>
<p>- MENGGUNAKAN BUNGA PALSU BAHAN KAIN & BUNGA KERING ASLI, JADI AWET & EVERLASTING.</p>
                '),
                'weight' => '2000',
                'stock_amount' => 0,
                'minimum_order' => 1
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Gift Wedding Jam 25x35cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813526/capstone-gits/Gift_Wedding_Jam_epr0dx.jpg',
                'price' => '150000',
                'capital_price' => '100000',
                'description' => trim('
<p>HARGA TERTERA UNTUK Gift Wedding Jam</p> 
<p>- Ukuran : 25x35cm</p>
<p>- Berat : 1,5kg</p>
<p>&nbsp</p>
<p>Format Tulisan :</p>
<p>(TULIS DI NOTES SAAT CHECKOUT)</p> 
<p>- Nama pasangan</p>
<p>- Tanggal</p>
<p>- Jam</p>
<p>- Tulisan ayat / kata kata lainnya</p>
<p>- Foto Pasangan</p>
<p>- Bouquet kecil</p>
<p>- Hiasan kupu-kupu</p>
<p>- Happy Wedding (otomatis ditulis sesuai foto produk)</p>
<p>CONTOH :</p>
<p>Ghoji & Mahda 27.04.2023, Ayat Ar Rum 21 Bahasa Indonesia</p>
<p>&nbsp</p>
<p>SUDAH TERMASUK :</p>
<p>- Bingkai Luar dengan Kaca Akrilik, jadi lebih aman saat pengiriman.</p>
<p>&nbsp</p>
<p>KELEBIHAN :</p>
<p>- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.</p>
<p>- Terdapat gantungan bingkai untuk digantung.</p>
                '),
                'weight' => '1500',
                'stock_amount' => 0,
                'minimum_order' => 1
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Cutting Acrylic 20x30cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813527/capstone-gits/Cutting_Acrylic_20x30_uhwyj2.jpg',
                'price' => '300000',
                'capital_price' => '220000',
                'description' => trim('
<p>HARGA TERTERA UNTUK Cutting Acrylic 20x30cm</p>
<p>- Ukuran : 20x30cm</p>
<p>- Berat : 1 kg</p>
<p>&nbsp</p>
<p>Format Tulisan :</p>
<p>(TULIS DI PESAN NOTES SAAT CHECKOUT)</p>
<p>- Nama pasangan</p>
<p>- Tanggal</p>
<p>CONTOH :</p>
<p>Aryo & Irna 24 Mei 2023</p>
<p>&nbsp</p>
<p>SUDAH TERMASUK :</p>
<p>- Uang Kertas Mainan maksimal 10 lembar, karena space terbatas.</p>
<p>- Bingkai Luar dengan Kaca Akrilik, jadi lebih aman saat pengiriman.</p>
<p>- Dekor Bunga Kain</p>
<p>- Uang koin 1.000 jadul</p>
<p>- Variasi buku nikah</p> 
<p>&nbsp</p>
<p>KELEBIHAN :</p>
<p>- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.</p>
<p>- Terdapat gantungan bingkai untuk digantung.</p>
<p>- Menggunakan bunga palsu bahan kain jadi Awet & Everlasting.</p>
                '),
                'weight' => '1000',
                'stock_amount' => 0,
                'minimum_order' => 1
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Cuttingg Acrylic 25x35cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813527/capstone-gits/Cuttingg_Acrylic_25x35cm_nkbsgo.jpg',
                'price' => '350000',
                'capital_price' => '300000',
                'description' => trim('
<p>HARGA TERTERA UNTUK Cutting Acrylic 25x35cm</p>
<p>- Ukuran : 25x35cm</p>
<p>- Berat : 3 kg</p>
<p>&nbsp</p>
<p>Format Tulisan:</p>
<p>(TULIS DI PESAN NOTES SAAT CHECKOUT)</p>
<p>- Nama pasangan</p>
<p>- Tanggal</p>
<p>CONTOH :</p>
<p>Riyanti & Lisa 15 Maret 2023</p>
<p>&nbsp</p>
<p>SUDAH TERMASUK:</p>
<p>- Uang Kertas Mainan maksimal 10 gulung, karena space terbatas.</p>
<p>- Bingkai Luar dengan Kaca Akrilik, jadi lebih aman saat pengiriman.</p>
<p>- Dekor Bunga Kain</p>
<p>- Variasi buku nikah</p> 
<p>&nbsp</p>
<p>KELEBIHAN:</p>
<p>- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.</p>
<p>- Terdapat gantungan bingkai untuk digantung.</p>
<p>- Menggunakan bunga palsu bahan kain jadi Awet & Everlasting.</p>
                '),
                'weight' => '3000',
                'stock_amount' => 0,
                'minimum_order' => 1
            ],
            [
                'categories_id' => $hantaran->id,
                'name' => 'Cutting Acrylic 25x35cm',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683813527/capstone-gits/Cutting_Acrylic_25x35cm_egww08.jpg',
                'price' => '320000',
                'capital_price' => '250000',
                'description' => trim('
<p>HARGA TERTERA UNTUK Cutting Acrylic 25x35cm</p>
<p>- Ukuran : 25x35cm</p>
<p>- Berat : 2 kg</p>
<p>Format Tulisan:</p>
<p>(TULIS DI PESAN NOTES SAAT CHECKOUT)</p>
<p>- Nama pasangan</p>
<p>- Tanggal</p>
<p>CONTOH :</p>
<p>Rizki & Cicik 18 Januari 2023</p>
<p>&nbsp</p>
<p>SUDAH TERMASUK:</p>
<p>- Bismillah (otomatis ditulis sesuai foto produk)</p>
<p>- Uang Kertas Mainan maksimal 10 gulung, karena space terbatas.</p>
<p>- Bingkai luar dengan Kaca Akrilik, jadi lebih aman saat pengiriman.</p>
<p>- Dekor Bunga Kain</p>
<p>&nbsp</p>
<p>KELEBIHAN:
<p>- Bingkai mudah dibuka, bukaan di sisi belakang seperti biasa.</p>
<p>- Terdapat gantungan bingkai untuk digantung.</p>
<p>- Menggunakan bunga palsu bahan kain jadi Awet & Everlasting.</p>
                '),
                'weight' => '2000',
                'stock_amount' => 0,
                'minimum_order' => 1
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
