<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();

            // Konten utama kartu
            $table->string('title');                        // Judul promo
            $table->string('price_highlight')->nullable();  // Teks highlight (mis. "Hemat s/d Rp 150.000")
            $table->text('description')->nullable();        // Sub-kalimat singkat

            // Gambar
            $table->string('image')->nullable();            // Path gambar upload

            // Badge (pojok kiri atas)
            $table->string('badge_text')->nullable();       // Teks badge (mis. "Promo Bulan Ini")
            $table->string('badge_icon')->nullable();       // Icon FA (mis. fas fa-fire)
            $table->string('badge_color')->nullable();      // Warna RGBA badge

            // Tag kategori
            $table->string('category_tag')->nullable();     // Label (mis. "Scaling & Pemutihan")
            $table->string('category_icon')->nullable();    // Icon FA (mis. fas fa-tooth)

            // Diskon (pojok kanan atas)
            $table->string('discount_value')->nullable();   // Nilai (mis. "43%", "0%")
            $table->string('discount_label')->nullable();   // Label (mis. "OFF", "cicilan")
            $table->string('discount_color_from')->nullable(); // Warna gradient start (hex)
            $table->string('discount_color_to')->nullable();   // Warna gradient end (hex)

            // Harga
            $table->unsignedBigInteger('price_from')->nullable();     // Harga promo (Rp)
            $table->unsignedBigInteger('price_original')->nullable(); // Harga normal sebelum promo
            $table->string('price_suffix')->nullable();               // Suffix ops (/bln, /gigi, dst)

            // CTA
            $table->string('cta_text')->default('Daftar');            // Teks tombol
            $table->text('whatsapp_message')->nullable();             // Pesan WA custom

            // Pengaturan
            $table->date('expires_at')->nullable();   // Tanggal kadaluarsa promo
            $table->unsignedSmallInteger('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
