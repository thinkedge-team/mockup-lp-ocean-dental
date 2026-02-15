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
                'badge' => 'founder',
                'status' => 'online',
                'rating' => 5.0,
                'review_count' => '2.5k+',
                'patient_count' => '10K+',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Indonesia',
                    'PDGI Certified',
                    'Advanced Aesthetic Dentistry Certificate',
                ],
                'expertise_tags' => ['Estetika Gigi', 'Veneer', 'Smile Design'],
                'university' => 'Universitas Indonesia',
                'years_of_experience' => 15,
                'bio' => 'Pendiri Ocean Dental dengan pengalaman 15+ tahun di bidang kedokteran gigi. Spesialis dalam perawatan estetik dan restorasi gigi.',
                'photo' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.aersy',
                    'linkedin' => 'https://linkedin.com/in/aersy-henny',
                ],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'drg. Michael Chen, Sp.Ort',
                'position' => 'Orthodontist',
                'specialization' => 'Orthodontics',
                'badge' => 'specialist',
                'status' => 'online',
                'rating' => 5.0,
                'review_count' => '1.8k+',
                'patient_count' => '5K+',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Indonesia',
                    'Spesialis Ortodonsia, Universitas Indonesia',
                    'Invisalign Certified Provider',
                ],
                'expertise_tags' => ['Behel', 'Invisalign', 'Ortodonti'],
                'university' => 'Universitas Indonesia',
                'years_of_experience' => 10,
                'bio' => 'Spesialis ortodonti dengan keahlian dalam perawatan behel dan aligner. Telah menangani 500+ kasus ortodonti dengan hasil memuaskan.',
                'photo' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.michael',
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'drg. Ayu Lestari',
                'position' => 'Cosmetic Dentist',
                'specialization' => 'Cosmetic Dentistry',
                'badge' => null,
                'status' => 'online',
                'rating' => 5.0,
                'review_count' => '2.1k+',
                'patient_count' => '8K+',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Trisakti',
                    'Certificate in Cosmetic Dentistry',
                    'Veneer Specialist Training',
                ],
                'expertise_tags' => ['Veneer', 'Bleaching', 'Bonding'],
                'university' => 'Universitas Trisakti',
                'years_of_experience' => 9,
                'bio' => 'Ahli kedokteran gigi kosmetik dengan fokus pada pemutihan gigi dan veneer. Dikenal dengan hasil yang natural dan memuaskan.',
                'photo' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop&crop=face',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.ayu',
                ],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'drg. David Santoso, Sp.BM',
                'position' => 'Oral Surgeon',
                'specialization' => 'Oral & Maxillofacial Surgery',
                'badge' => 'specialist',
                'status' => 'busy',
                'rating' => 5.0,
                'review_count' => '1.5k+',
                'patient_count' => '4K+',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Gadjah Mada',
                    'Spesialis Bedah Mulut, Universitas Gadjah Mada',
                    'Dental Implant Specialist Certification',
                ],
                'expertise_tags' => ['Implan Gigi', 'Bedah Mulut', 'Wisdom Tooth'],
                'university' => 'Universitas Gadjah Mada',
                'years_of_experience' => 12,
                'bio' => 'Ahli bedah mulut dengan spesialisasi implant gigi dan bedah kompleks. Berpengalaman menangani kasus-kasus bedah oral yang rumit.',
                'photo' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=400&h=400&fit=crop&crop=face',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.david',
                    'linkedin' => 'https://linkedin.com/in/david-santoso-dds',
                ],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'drg. Lisa Kusuma',
                'position' => 'Pediatric Dentist',
                'specialization' => 'Pediatric Dentistry',
                'badge' => null,
                'status' => 'online',
                'rating' => 5.0,
                'review_count' => '1.9k+',
                'patient_count' => '6K+',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Airlangga',
                    'Sertifikat Kedokteran Gigi Anak',
                    'Child Psychology in Dentistry',
                ],
                'expertise_tags' => ['Anak', 'Preventif', 'Fluoride'],
                'university' => 'Universitas Airlangga',
                'years_of_experience' => 8,
                'bio' => 'Dokter gigi anak yang ramah dan sabar. Ahli dalam menangani perawatan gigi anak dengan pendekatan yang menyenangkan.',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&crop=face',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.lisa',
                ],
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'drg. Ryan Pratama',
                'position' => 'Prosthodontist',
                'specialization' => 'Prosthodontics',
                'badge' => 'specialist',
                'status' => 'online',
                'rating' => 5.0,
                'review_count' => '1.3k+',
                'patient_count' => '3.5K+',
                'qualifications' => [
                    'Sarjana Kedokteran Gigi, Universitas Padjadjaran',
                    'Spesialis Prostodonsia',
                    'Advanced Crown & Bridge Certificate',
                ],
                'expertise_tags' => ['Crown', 'Bridge', 'Denture'],
                'university' => 'Universitas Padjadjaran',
                'years_of_experience' => 11,
                'bio' => 'Spesialis prostodontik dengan keahlian dalam restorasi gigi dan pembuatan gigi tiruan. Fokus pada kenyamanan dan estetika.',
                'photo' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&h=400&fit=crop&crop=face',
                'social_links' => [
                    'instagram' => 'https://instagram.com/drg.ryan',
                ],
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}
