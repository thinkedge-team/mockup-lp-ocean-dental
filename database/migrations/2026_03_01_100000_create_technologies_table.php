<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();

            // Konten utama
            $table->string('name');                        // Nama teknologi, mis. "Laser Dental"
            $table->string('tag')->nullable();             // Label pojok gambar, mis. "Diode Laser"
            $table->text('description')->nullable();       // Deskripsi singkat

            // Gambar
            $table->string('image')->nullable();           // Path upload ke storage/technologies/

            // Highlight utama (tech-hero)
            $table->boolean('is_highlight')->default(false); // Hanya 1 aktif sebagai hero
            $table->string('eyebrow_text')->nullable();    // Teks kecil di atas judul highlight
            $table->json('feature_list')->nullable();      // Daftar bullet keunggulan (array of string)

            // Pengaturan
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technologies');
    }
};
