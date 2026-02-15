<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa biaya pemasangan veneer di Ocean Dental?',
                'answer' => 'Biaya pemasangan veneer bervariasi tergantung jenis material dan jumlah gigi yang akan dipasang. Untuk veneer composite mulai dari Rp 1.5 juta per gigi, sedangkan veneer porcelain mulai dari Rp 4 juta per gigi. Kami menyediakan konsultasi gratis untuk memberikan estimasi biaya yang lebih akurat sesuai kebutuhan Anda.',
                'category' => 'biaya',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah pemasangan behel terasa sakit?',
                'answer' => 'Proses pemasangan behel tidak terasa sakit karena tidak memerlukan anestesi. Setelah pemasangan, Anda mungkin merasakan sedikit ketidaknyamanan atau gigi terasa ngilu selama 3-5 hari pertama saat gigi mulai bergerak. Kami akan memberikan tips dan obat pereda nyeri jika diperlukan untuk memastikan kenyamanan Anda.',
                'category' => 'perawatan',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama waktu yang dibutuhkan untuk bleaching?',
                'answer' => 'Prosedur bleaching di klinik membutuhkan waktu sekitar 60-90 menit dalam satu kali kunjungan. Hasilnya langsung terlihat dengan gigi yang bisa menjadi 4-8 tingkat lebih putih. Untuk hasil yang lebih optimal, kami menyediakan paket home bleaching yang bisa dilanjutkan di rumah.',
                'category' => 'perawatan',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah Ocean Dental menerima pembayaran cicilan?',
                'answer' => 'Ya, kami menerima berbagai metode pembayaran termasuk cicilan 0% dengan kartu kredit dari berbagai bank partner. Untuk perawatan dengan biaya tertentu, tersedia juga opsi cicilan internal tanpa kartu kredit. Silakan konsultasikan dengan tim kami untuk informasi lebih detail tentang opsi pembayaran.',
                'category' => 'biaya',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah harus membuat janji terlebih dahulu?',
                'answer' => 'Kami sangat menyarankan untuk membuat janji terlebih dahulu melalui WhatsApp atau telepon untuk memastikan ketersediaan dokter dan menghindari waktu tunggu yang lama. Namun, kami juga menerima pasien walk-in dengan catatan akan dilayani sesuai antrian yang ada.',
                'category' => 'umum',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama garansi untuk perawatan gigi?',
                'answer' => 'Garansi perawatan berbeda-beda tergantung jenis tindakan. Untuk tambal gigi, garansi 6 bulan. Crown dan bridge memiliki garansi 1 tahun. Veneer porcelain garansi 2 tahun. Implan gigi garansi hingga 5 tahun. Garansi berlaku dengan syarat kontrol rutin sesuai jadwal yang ditentukan dokter.',
                'category' => 'garansi',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
