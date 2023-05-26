<?php

namespace Database\Seeders;

use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'question' => 'Bagaimana cara melakukan pemesanan ?',
                'answer' => 'Buka Website GiftMoment dan login ke akun Anda
                             -> Cari produk yang ingin Anda beli
                             -> Setelah menemukan produk yang diinginkan, klik "Tambah ke Keranjang" jika Anda ingin melanjutkan belanja, Anda dapat mengakses keranjang belanja Anda untuk melakukan checkout kemudian Anda akan diarahkan ke halaman pembayaran untuk memasukkan alamat pengiriman dan memilih metode pembayaran.',
            ],
            [
                'question' => 'Bagaimana cara melakukan pembayaran ?',
                'answer' => 'Kami menyediakan berbagai metode pembayaran, termasuk transfer bank, kartu kredit, dan e-wallet.Setelah memilih produk dan alamat pengiriman, Anda dapat memilih metode pembayaran yang diinginkan saat melakukan checkout.',
            ],
            [
                'question' => 'Berapa lama waktu pengiriman produk ?',
                'answer' => 'Waktu pengiriman produk kurang lebih 3 s/d 14 hari tergantung kepada lokasi pengiriman. Anda dapat menemukan perkiraan waktu pengiriman yang ditampilkan di halaman produk atau saat melakukan checkout.',
            ],
            [
                'question' => 'Apakah ada garansi atau kebijakan retur barang jika tidak sesuai dengan pesanan atau rusak ?',
                'answer' => 'Kami juga memiliki kebijakan Perlindungan Pembeli yang memberikan jaminan bagi pembeli jika barang tidak sesuai atau rusak.Jika Anda menerima barang yang tidak sesuai atau rusak, Anda dapat menghubungi nomer admin yang tertera',
            ],
            [
                'question' => 'Bagaimana cara menghubungi customer service jika ada masalah atau pertanyaan terkait produk atau pembelian?',
                'answer' => 'Kami menyediakan layanan customer service yang siap membantu Anda. Anda dapat menghubungi nomor telepon admin yang tercantum di website. Kami dengan senang hati membantu menjawab pertanyaan atau menyelesaikan masalah yang Anda hadapi.',
            ],
        ];

        foreach ($data as $value) {
            Faq::insert([
                'id' => Str::uuid(),
                'question' => $value['question'],
                'answer' => $value['answer'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
