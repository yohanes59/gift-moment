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
                'question' => 'Apa nanti bisa di tukar jika barangnya tidak cocok ?',
                'answer' => 'Mohon maaf barang yang sudah anda pesan tidak bisa di tukar, karena karyawan kami mengirim sesuai pesanan anda',
            ],
            [
                'question' => 'Untuk pengiriman berapa lama ?',
                'answer' => 'Jika pengiriman menggunakan J&T sekitar kurang lebih 3 s/d 14 hari',
            ],
            [
                'question' => 'Jika ingin pesan, bagaimana cara pembayarannya ?',
                'answer' => 'Untuk pembayaran bisa di transfer ke no rekening yang tertera',
            ],
            [
                'question' => 'Batas Transfer sampai kapan ya ?',
                'answer' => 'Batas transfernya adalah 2 x 24 jam.Apabila lebih dari itu, kami akan membatalkan pesanan Anda secara otomatis',
            ],
            [
                'question' => 'Selama pengiriman nanti boxnya bisa penyok/rusak tidak ya ?',
                'answer' => 'Untuk pengiriman kita mempacking boxnya bubble 2 lapis, Namun karena ada oknum yang benar-benar kasar, maka boxnya bisa penyok juga. tetapi kemungkinannya hanya 15%.',
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
