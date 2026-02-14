<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'drg. Aersy Henny Paramitha',
                'position' => 'Founder & Lead Dentist',
                'specialization' => 'General Dentistry & Aesthetic',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Trisakti',
                    'PDGI Certified',
                    'Advanced Aesthetic Dentistry Certificate',
                ],
                'years_of_experience' => 15,
                'bio' => 'Pendiri Ocean Dental dengan pengalaman 15+ tahun di bidang kedokteran gigi. Spesialis dalam perawatan estetik dan restorasi gigi.',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.aersy',
                    'linkedin' => 'https://linkedin.com/in/aersy-henny',
                ],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'drg. Michael Santoso, Sp.Ort',
                'position' => 'Orthodontist',
                'specialization' => 'Orthodontics',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Indonesia',
                    'Spesialis Ortodonsia, Universitas Indonesia',
                    'Invisalign Certified Provider',
                ],
                'years_of_experience' => 10,
                'bio' => 'Spesialis ortodonti dengan keahlian dalam perawatan behel dan aligner. Telah menangani 500+ kasus ortodonti dengan hasil memuaskan.',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.michael',
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'drg. David Pratama, Sp.BM',
                'position' => 'Oral Surgeon',
                'specialization' => 'Oral & Maxillofacial Surgery',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Gadjah Mada',
                    'Spesialis Bedah Mulut, Universitas Gadjah Mada',
                    'Dental Implant Specialist Certification',
                ],
                'years_of_experience' => 12,
                'bio' => 'Ahli bedah mulut dengan spesialisasi implant gigi dan bedah kompleks. Berpengalaman menangani kasus-kasus bedah oral yang rumit.',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.david',
                    'linkedin' => 'https://linkedin.com/in/david-pratama-dds',
                ],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'drg. Lisa Margaretha',
                'position' => 'Pediatric Dentist',
                'specialization' => 'Pediatric Dentistry',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Airlangga',
                    'Sertifikat Kedokteran Gigi Anak',
                    'Child Psychology in Dentistry',
                ],
                'years_of_experience' => 8,
                'bio' => 'Dokter gigi anak yang ramah dan sabar. Ahli dalam menangani perawatan gigi anak dengan pendekatan yang menyenangkan.',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.lisa',
                ],
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}
