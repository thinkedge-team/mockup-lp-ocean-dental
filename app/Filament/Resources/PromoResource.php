<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoResource\Pages;
use App\Models\Promo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromoResource extends Resource
{
    protected static ?string $model = Promo::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Promo';

    protected static ?string $modelLabel = 'Promo';

    protected static ?string $pluralModelLabel = 'Promo';

    // ───────────────────────────────────────────────────────
    // Semua pilihan warna preset
    // ───────────────────────────────────────────────────────

    protected static array $badgeColorOptions = [
        'rgba(59,130,246,.9)'  => '🔵 Biru',
        'rgba(124,58,237,.9)'  => '🟣 Ungu',
        'rgba(5,150,105,.9)'   => '🟢 Hijau',
        'rgba(234,88,12,.9)'   => '🟠 Oranye',
        'rgba(239,68,68,.9)'   => '🔴 Merah',
        'rgba(245,158,11,.9)'  => '🟡 Kuning',
        'rgba(20,184,166,.9)'  => '🩵 Teal',
        'rgba(99,102,241,.9)'  => '🔷 Indigo',
    ];

    protected static array $discountColorOptions = [
        '#EF4444' => '🔴 Merah',
        '#DC2626' => '🔴 Merah Tua',
        '#7C3AED' => '🟣 Ungu',
        '#5B21B6' => '🟣 Ungu Tua',
        '#059669' => '🟢 Hijau',
        '#047857' => '🟢 Hijau Tua',
        '#EA580C' => '🟠 Oranye',
        '#C2410C' => '🟠 Oranye Tua',
        '#2563EB' => '🔵 Biru',
        '#1D4ED8' => '🔵 Biru Tua',
        '#D97706' => '🟡 Kuning',
        '#B45309' => '🟡 Kuning Tua',
    ];

    // ───────────────────────────────────────────────────────
    // FORM
    // ───────────────────────────────────────────────────────

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // ── 1. Informasi Utama ───────────────────────────
                Forms\Components\Section::make('📋 Informasi Utama')
                    ->description('Teks yang tampil di bagian bawah kartu promo.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Promo')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Paket Scaling + Bleaching')
                            ->helperText('Judul utama kartu promo. Tampil besar di tengah kartu.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('price_highlight')
                            ->label('Teks Highlight Harga')
                            ->maxLength(80)
                            ->placeholder('Hemat s/d Rp 150.000')
                            ->helperText('Teks singkat di bawah judul — biasanya berisi penghematan atau keuntungan utama.'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->rows(2)
                            ->maxLength(200)
                            ->placeholder('Gigi bersih & cerah dalam 1 kunjungan. Berlaku di semua cabang.')
                            ->helperText('Kalimat pendek yang menjelaskan keunggulan promo ini.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                // ── 2. Gambar ────────────────────────────────────
                Forms\Components\Section::make('🖼️ Gambar Kartu')
                    ->description('Gambar latar kartu promo. Sangat direkomendasikan untuk menggunakan foto yang relevan.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Upload Gambar')
                            ->image()
                            ->disk('public')
                            ->directory('promos')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9'])
                            ->maxSize(2048)
                            ->helperText('Ukuran ideal: 1280×720px (landscape 16:9). Format: JPG/PNG/WebP. Maks 2MB. Jika tidak diisi, kartu akan menampilkan latar placeholder.')
                            ->columnSpanFull(),
                    ]),

                // ── 3. Badge & Kategori ──────────────────────────
                Forms\Components\Section::make('🏷️ Badge & Kategori')
                    ->description('Badge muncul di pojok kiri atas. Kategori muncul sebagai label kecil di atas judul.')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Teks Badge')
                            ->maxLength(40)
                            ->placeholder('Promo Bulan Ini')
                            ->helperText('Contoh: "Promo Bulan Ini", "Flash Sale", "Terbatas". Tampil di pojok kiri atas kartu.'),

                        Forms\Components\TextInput::make('badge_icon')
                            ->label('Icon Badge')
                            ->maxLength(60)
                            ->placeholder('fas fa-fire')
                            ->helperText('Kelas Font Awesome. Contoh: fas fa-fire, fas fa-star, fas fa-gem, fas fa-award.'),

                        Forms\Components\Select::make('badge_color')
                            ->label('Warna Badge')
                            ->options(self::$badgeColorOptions)
                            ->searchable()
                            ->nullable()
                            ->helperText('Pilih warna latar untuk badge. Warna ini juga digunakan sebagai warna label kategori.'),

                        Forms\Components\TextInput::make('category_tag')
                            ->label('Label Kategori')
                            ->maxLength(60)
                            ->placeholder('Scaling & Pemutihan')
                            ->helperText('Contoh: "Scaling & Pemutihan", "Ortodonti", "Estetika". Tampil di atas judul.'),

                        Forms\Components\TextInput::make('category_icon')
                            ->label('Icon Kategori')
                            ->maxLength(60)
                            ->placeholder('fas fa-tooth')
                            ->helperText('Icon Font Awesome untuk label kategori. Contoh: fas fa-tooth, fas fa-teeth, fas fa-smile.'),
                    ])
                    ->columns(2),

                // ── 4. Badge Diskon ──────────────────────────────
                Forms\Components\Section::make('🔖 Badge Diskon')
                    ->description('Badge diskon muncul di pojok kanan atas kartu. Kosongkan semua field ini jika tidak ingin menampilkan badge diskon.')
                    ->schema([
                        Forms\Components\TextInput::make('discount_value')
                            ->label('Nilai Diskon')
                            ->maxLength(10)
                            ->placeholder('43%')
                            ->helperText('Nilai yang tampil besar. Contoh: "43%", "0%", "20%", "GRATIS".'),

                        Forms\Components\Select::make('discount_label')
                            ->label('Label Diskon')
                            ->options([
                                'OFF'     => 'OFF (diskon biasa)',
                                'cicilan' => 'cicilan (cicilan 0%)',
                                'GRATIS'  => 'GRATIS',
                                'HEMAT'   => 'HEMAT',
                                'BONUS'   => 'BONUS',
                            ])
                            ->nullable()
                            ->helperText('Label kecil di bawah nilai diskon.'),

                        Forms\Components\Select::make('discount_color_from')
                            ->label('Warna Gradasi Kiri')
                            ->options(self::$discountColorOptions)
                            ->nullable()
                            ->default('#EF4444')
                            ->helperText('Warna awal gradasi badge diskon.'),

                        Forms\Components\Select::make('discount_color_to')
                            ->label('Warna Gradasi Kanan')
                            ->options(self::$discountColorOptions)
                            ->nullable()
                            ->default('#DC2626')
                            ->helperText('Warna akhir gradasi badge diskon.'),
                    ])
                    ->columns(2),

                // ── 5. Harga ─────────────────────────────────────
                Forms\Components\Section::make('💰 Informasi Harga')
                    ->description('Harga tampil di footer kartu. "Harga Normal" akan tampil dengan garis coret jika diisi.')
                    ->schema([
                        Forms\Components\TextInput::make('price_from')
                            ->label('Harga Promo')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('199000')
                            ->helperText('Harga setelah promo dalam Rupiah. Contoh: 199000 akan tampil sebagai "Rp 199.000". Kosongkan jika tidak ingin menampilkan harga.'),

                        Forms\Components\TextInput::make('price_original')
                            ->label('Harga Normal (Sebelum Promo)')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('350000')
                            ->helperText('Harga asli sebelum diskon. Akan tampil dengan garis coret di sebelah harga promo. Kosongkan jika tidak perlu.')
                            ->nullable(),

                        Forms\Components\TextInput::make('price_suffix')
                            ->label('Keterangan Tambahan Harga')
                            ->maxLength(20)
                            ->placeholder('/bln')
                            ->helperText('Opsional. Tambahan setelah harga. Contoh: "/bln" untuk cicilan bulanan, "/gigi" untuk per gigi.')
                            ->nullable(),
                    ])
                    ->columns(3),

                // ── 6. CTA & WhatsApp ────────────────────────────
                Forms\Components\Section::make('📱 Tombol Aksi (CTA)')
                    ->description('Tombol di pojok kanan bawah kartu untuk mengundang pasien berinteraksi via WhatsApp.')
                    ->schema([
                        Forms\Components\TextInput::make('cta_text')
                            ->label('Teks Tombol')
                            ->required()
                            ->maxLength(30)
                            ->default('Daftar')
                            ->placeholder('Daftar')
                            ->helperText('Contoh: "Daftar", "Konsultasi", "Tanya Harga", "Pesan Sekarang". Tombol selalu dilengkapi ikon WhatsApp.'),

                        Forms\Components\Textarea::make('whatsapp_message')
                            ->label('Pesan WhatsApp')
                            ->rows(2)
                            ->maxLength(300)
                            ->placeholder('Halo, saya tertarik dengan promo Paket Scaling + Bleaching')
                            ->helperText('Pesan yang akan terisi otomatis saat pasien klik tombol WhatsApp. Jika kosong, akan menggunakan pesan default berdasarkan judul promo.')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                // ── 7. Pengaturan ────────────────────────────────
                Forms\Components\Section::make('⚙️ Pengaturan')
                    ->description('Konfigurasi visibilitas dan urutan tampil promo.')
                    ->schema([
                        Forms\Components\DatePicker::make('expires_at')
                            ->label('Tanggal Berakhir Promo')
                            ->nullable()
                            ->displayFormat('d M Y')
                            ->minDate(now())
                            ->helperText('Tanggal terakhir promo berlaku (opsional). Tampil di kartu sebagai "s/d [tanggal]". Promo tidak otomatis dinonaktifkan saat kadaluarsa — Anda perlu menonaktifkannya secara manual.'),

                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Angka lebih kecil tampil lebih awal di slider. Contoh: 0, 1, 2, 3'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true)
                            ->onIcon('heroicon-s-eye')
                            ->offIcon('heroicon-s-eye-slash')
                            ->helperText('Matikan untuk menyembunyikan promo dari halaman utama tanpa menghapusnya.'),
                    ])
                    ->columns(3),

            ]);
    }

    // ───────────────────────────────────────────────────────
    // TABLE
    // ───────────────────────────────────────────────────────

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width(50),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->width(120)
                    ->height(68)
                    ->defaultImageUrl(asset('images/no-image.jpg')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Promo')
                    ->searchable()
                    ->limit(35)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('discount_value')
                    ->label('Diskon')
                    ->badge()
                    ->color('danger')
                    ->formatStateUsing(fn ($state, $record) =>
                        $state ? "{$state} {$record->discount_label}" : '—'
                    ),

                Tables\Columns\TextColumn::make('price_from')
                    ->label('Harga Promo')
                    ->formatStateUsing(fn ($state) =>
                        $state ? 'Rp ' . number_format($state, 0, ',', '.') : '—'
                    )
                    ->sortable(),

                Tables\Columns\TextColumn::make('expires_at')
                    ->label('Berlaku s/d')
                    ->date('d M Y')
                    ->sortable()
                    ->color(fn ($record) => $record?->is_expired ? 'danger' : null)
                    ->formatStateUsing(fn ($state, $record) =>
                        $state
                            ? ($record->is_expired ? '⚠ Kadaluarsa — ' : '') . $record->expires_at->translatedFormat('d M Y')
                            : 'Tidak ada batas'
                    ),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),

                Tables\Filters\Filter::make('expired')
                    ->label('Sudah Kadaluarsa')
                    ->query(fn ($query) =>
                        $query->whereNotNull('expires_at')->whereDate('expires_at', '<', now())
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip('Edit Promo'),
                Tables\Actions\DeleteAction::make()
                    ->tooltip('Hapus Promo'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc')
            ->emptyStateHeading('Belum ada promo')
            ->emptyStateDescription('Tambah promo pertama Anda dengan klik tombol "Buat Promo" di atas.')
            ->emptyStateIcon('heroicon-o-tag');
    }

    // ───────────────────────────────────────────────────────
    // PAGES
    // ───────────────────────────────────────────────────────

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPromos::route('/'),
            'create' => Pages\CreatePromo::route('/create'),
            'edit'   => Pages\EditPromo::route('/{record}/edit'),
        ];
    }
}
