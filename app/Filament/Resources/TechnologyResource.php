<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnologyResource\Pages;
use App\Models\Technology;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TechnologyResource extends Resource
{
    protected static ?string $model = Technology::class;

    protected static ?string $navigationIcon  = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int    $navigationSort  = 4;
    protected static ?string $navigationLabel = 'Teknologi';
    protected static ?string $modelLabel      = 'Teknologi';
    protected static ?string $pluralModelLabel = 'Teknologi';

    // ── FORM ─────────────────────────────────────────────────────────────────

    public static function form(Form $form): Form
    {
        return $form->schema([

            // ── SECTION 1: Informasi Utama ────────────────────────────────
            Forms\Components\Section::make('Informasi Utama')
                ->description('Isi nama dan deskripsi singkat teknologi ini.')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Teknologi')
                        ->placeholder('mis. Laser Dental')
                        ->helperText('Nama singkat yang ditampilkan sebagai judul kartu.')
                        ->required()
                        ->maxLength(100),

                    Forms\Components\TextInput::make('tag')
                        ->label('Label / Tag')
                        ->placeholder('mis. Diode Laser')
                        ->helperText('Teks kecil di pojok kiri atas gambar (opsional).')
                        ->maxLength(50),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->placeholder('Jelaskan keunggulan teknologi ini secara singkat...')
                        ->helperText('Tampil sebagai teks di bawah nama teknologi. Maksimal 200 karakter.')
                        ->rows(3)
                        ->maxLength(200),
                ])
                ->columns(2),

            // ── SECTION 2: Foto Teknologi ─────────────────────────────────
            Forms\Components\Section::make('Foto Teknologi')
                ->description('Upload foto peralatan atau ilustrasi teknologi ini.')
                ->icon('heroicon-o-photo')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Foto')
                        ->helperText('Format: JPG/PNG/WebP. Maks 2MB. Rasio ideal 16:9 untuk tampilan terbaik.')
                        ->disk('public')
                        ->directory('technologies')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->columnSpanFull(),
                ]),

            // ── SECTION 3: Highlight Utama ────────────────────────────────
            Forms\Components\Section::make('Highlight Utama')
                ->description('Aktifkan jika teknologi ini tampil sebagai item utama (hero) di bagian atas section. Hanya 1 item yang bisa menjadi highlight — mengaktifkan ini akan otomatis menonaktifkan highlight sebelumnya.')
                ->icon('heroicon-o-star')
                ->schema([
                    Forms\Components\Toggle::make('is_highlight')
                        ->label('Jadikan sebagai Highlight Utama')
                        ->helperText('Item highlight ditampilkan lebih besar di bagian atas section teknologi, dilengkapi daftar fitur keunggulan.')
                        ->live()
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            if (! $state) {
                                $set('eyebrow_text', null);
                            }
                        }),

                    Forms\Components\TextInput::make('eyebrow_text')
                        ->label('Teks Eyebrow')
                        ->placeholder('mis. Andalan Kami')
                        ->helperText('Teks kecil yang muncul di atas judul highlight (opsional).')
                        ->maxLength(60)
                        ->visible(fn (Forms\Get $get) => (bool) $get('is_highlight')),

                    Forms\Components\Repeater::make('feature_list')
                        ->label('Daftar Keunggulan')
                        ->helperText('Tambahkan poin-poin keunggulan teknologi ini (maksimal 6 poin). Tampil sebagai bullet list di highlight.')
                        ->schema([
                            Forms\Components\TextInput::make('item')
                                ->label('Poin Keunggulan')
                                ->placeholder('mis. Radiasi 90% lebih rendah dari rontgen konvensional')
                                ->required()
                                ->maxLength(120),
                        ])
                        ->addActionLabel('+ Tambah Poin Keunggulan')
                        ->maxItems(6)
                        ->reorderable()
                        ->collapsible()
                        ->defaultItems(0)
                        ->visible(fn (Forms\Get $get) => (bool) $get('is_highlight'))
                        ->columnSpanFull(),
                ]),

            // ── SECTION 4: Pengaturan ─────────────────────────────────────
            Forms\Components\Section::make('Pengaturan Tampilan')
                ->description('Atur urutan dan visibilitas di website.')
                ->icon('heroicon-o-cog-6-tooth')
                ->schema([
                    Forms\Components\TextInput::make('order')
                        ->label('Urutan Tampil')
                        ->helperText('Angka lebih kecil tampil lebih dahulu. Highlight selalu tampil di atas terlepas dari urutan.')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(999),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Tampilkan di Website')
                        ->helperText('Nonaktifkan untuk menyembunyikan sementara tanpa menghapus data.')
                        ->default(true),
                ])
                ->columns(2),
        ]);
    }

    // ── TABLE ─────────────────────────────────────────────────────────────────

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width(50),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->width(100)
                    ->height(60)
                    ->defaultImageUrl(asset('images/no-image.jpg')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Teknologi')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Technology $record) => $record->tag ?? '—'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_highlight')
                    ->label('Highlight')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning')
                    ->tooltip(fn (Technology $record) => $record->is_highlight ? 'Tampil sebagai Highlight Utama' : 'Card biasa'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif saja')
                    ->falseLabel('Nonaktif saja')
                    ->placeholder('Semua'),

                Tables\Filters\TernaryFilter::make('is_highlight')
                    ->label('Tipe')
                    ->trueLabel('Highlight saja')
                    ->falseLabel('Card biasa saja')
                    ->placeholder('Semua tipe'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus yang dipilih'),
                ]),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order');
    }

    // ── PAGES ─────────────────────────────────────────────────────────────────

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTechnologies::route('/'),
            'create' => Pages\CreateTechnology::route('/create'),
            'edit'   => Pages\EditTechnology::route('/{record}/edit'),
        ];
    }

    // ── MUTATE BEFORE SAVE: pastikan hanya 1 highlight ───────────────────────

    /**
     * Dipanggil sebelum record baru/edit disimpan.
     * Jika is_highlight = true, nonaktifkan highlight lain terlebih dulu.
     */
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        return static::ensureSingleHighlight($data);
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        return static::ensureSingleHighlight($data);
    }

    protected static function ensureSingleHighlight(array $data): array
    {
        if (! empty($data['is_highlight'])) {
            Technology::where('is_highlight', true)->update(['is_highlight' => false]);
        }

        return $data;
    }
}
