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
                'answer' => '1. Buka website GiftMoment dan login ke akun Anda. Jika Anda belum memiliki akun, Anda dapat mendaftar terlebih dahulu.
                             2. Cari produk yang ingin Anda beli. Anda dapat menggunakan fitur pencarian atau menjelajahi kategori produk yang tersedia.
                             3. Setelah menemukan produk yang diinginkan, klik "Tambah ke Keranjang" untuk memasukkan produk ke dalam keranjang belanja Anda.
                             4. Jika Anda ingin melanjutkan belanja, Anda dapat kembali mencari produk lain dan menambahkannya ke keranjang belanja.
                             Jika Anda memiliki pertanyaan lebih lanjut atau mengalami masalah selama proses pemesanan, jangan ragu untuk menghubungi layanan pelanggan kami untuk bantuan tambahan.',
            ],
            [
                'question' => 'Bagaimana cara melakukan pembayaran ?',
                'answer' => '1. Setelah selesai memilih produk, akses keranjang belanja Anda untuk melakukan checkout. Anda dapat menemukan opsi untuk checkout di halaman keranjang belanja.
                             2. Anda akan diarahkan ke halaman checkout. Periksa kembali pesanan Anda untuk memastikan semua detail yang benar, termasuk alamat pengiriman, jumlah barang, dan total pembayaran.
                             3. Setelah Anda yakin dengan pesanan Anda, klik "Bayar Sekarang" yang mengarahkan Anda ke halaman pembayaran.
                             4. Di halaman pembayaran, Anda akan diberikan pilihan metode pembayaran yang tersedia. Pilih metode pembayaran yang Anda inginkan, seperti kartu kredit, transfer bank, atau metode pembayaran elektronik lainnya.
                             5. Setelah memilih metode pembayaran, masukkan informasi yang diperlukan, seperti nomor kartu kredit atau detail akun pembayaran elektronik.
                             6. Periksa kembali semua detail pembayaran yang Anda masukkan untuk memastikan keakuratan informasi.
                             7. Setelah yakin dengan informasi yang Anda berikan, klik "Bayar" untuk mengirim pembayaran.
                             8. Tunggu konfirmasi pembayaran. Setelah pembayaran Anda berhasil diproses, Anda dapat melihat rincian pesanan Anda, termasuk status pembayaran dan status pesanan, di halaman riwayat pesanan di akun Anda.
                             Jika Anda mengalami kesulitan atau memiliki pertanyaan tentang pembayaran, jangan ragu untuk menghubungi layanan pelanggan kami untuk bantuan lebih lanjut.',
            ],
            [
                'question' => 'Berapa lama waktu pengiriman produk ?',
                'answer' => '- Setelah Anda menyelesaikan pembelian, pesanan Anda akan diproses dalam waktu maksimal 3 hari sebelum dikirim. Proses ini meliputi verifikasi pembayaran, pengepakan, dan penyiapan pesanan.Estimasi waktu pengiriman produk setelah pesanan dikirim bervariasi tergantung pada jasa pengiriman yang digunakan dan lokasi pengiriman Anda. Secara umum, waktu pengiriman produk biasanya membutuhkan waktu sekitar 2-7 hari kerja setelah pesanan dikirim.
                             - Namun, perlu diperhatikan bahwa estimasi waktu pengiriman bersifat perkiraan dan dapat dipengaruhi oleh faktor-faktor seperti jarak geografis, kebijakan pengiriman, cuaca, serta situasi yang tidak terduga. Kami bekerja sama dengan jasa pengiriman yang terpercaya untuk memastikan pesanan Anda sampai dengan aman dan sesuai waktu.
                             Untuk mendapatkan perkiraan waktu pengiriman yang lebih akurat, Anda dapat melihat informasi yang diberikan saat checkout atau menghubungi layanan pelanggan kami untuk bantuan tambahan. Kami akan dengan senang hati membantu Anda melacak status pengiriman pesanan Anda.',
            ],
            [
                'question' => 'Apakah ada garansi atau kebijakan retur barang jika tidak sesuai dengan pesanan atau rusak ?',
                'answer' => '- Kami mohon maaf, tetapi kami tidak menyediakan garansi atau kebijakan retur barang untuk barang yang tidak sesuai dengan pesanan atau rusak. Barang yang kami kirim telah melalui proses pemeriksaan yang teliti oleh staf kami untuk memastikan kualitasnya sebelum dikirim kepada pelanggan.
                             - Namun, kami berusaha untuk memberikan deskripsi yang akurat dan menyediakan informasi yang jelas mengenai barang yang kami jual agar Anda dapat membuat keputusan pembelian yang tepat. Jika Anda memiliki kekhawatiran atau pertanyaan sehubungan dengan pesanan Anda, silakan hubungi tim layanan pelanggan kami, dan kami akan berusaha membantu Anda sebaik mungkin.
                             Kami berharap Anda dapat memahami kebijakan kami dalam hal ini. Terima kasih atas pengertian Anda.',
            ],
            [
                'question' => 'Bagaimana cara menghubungi customer service jika ada masalah atau pertanyaan terkait produk atau pembelian?',
                'answer' => 'Untuk mendapatkan bantuan terkait masalah atau pertanyaan terkait produk atau pembelian, Anda dapat menghubungi tim layanan pelanggan kami. Silakan menghubungi kami melalui nomor whatsapp +6285656424170. Tim kami akan dengan senang hati membantu Anda dengan masalah atau pertanyaan yang Anda miliki.',
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
