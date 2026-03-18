<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Filament\Resources\TeamMemberResource\RelationManagers;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    
    protected static ?string $navigationGroup = 'Content';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ── Section 1: Identitas Dokter ──
                Forms\Components\Section::make('Identitas Dokter')
                    ->description('Nama lengkap, jabatan, dan badge yang ditampilkan di kartu dokter.')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('position')
                            ->label('Jabatan / Spesialisasi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Dokter Gigi Umum, Orthodontist'),
                        Forms\Components\Select::make('badge')
                            ->label('Badge')
                            ->options([
                                'founder'    => 'Founder',
                                'specialist' => 'Specialist',
                            ])
                            ->placeholder('— Tanpa Badge —')
                            ->nullable(),
                    ])
                    ->columns(2),

                // ── Section 2: Foto Profil ──
                Forms\Components\Section::make('Foto Profil')
                    ->description('Upload foto dokter yang akan ditampilkan di website.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto Dokter')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['1:1', '3:2', '4:3', '16:9'])
                            ->directory('team-members')
                            ->maxSize(3072)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                            ->helperText('Rekomendasi: foto persegi (1:1) minimal 400×400px. Format: JPG, PNG, WebP. Maks 3MB.')
                            ->columnSpanFull(),
                    ]),

                // ── Section 3: Latar Belakang ──
                Forms\Components\Section::make('Latar Belakang')
                    ->description('Informasi pendidikan, pengalaman, dan deskripsi singkat dokter.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\TextInput::make('university')
                            ->label('Universitas / Institusi')
                            ->maxLength(255)
                            ->placeholder('Contoh: Universitas Indonesia'),
                        Forms\Components\TextInput::make('years_of_experience')
                            ->label('Lama Pengalaman')
                            ->numeric()
                            ->suffix('tahun')
                            ->minValue(0)
                            ->placeholder('0'),
                        Forms\Components\RichEditor::make('bio')
                            ->label('Bio / Deskripsi Dokter')
                            ->helperText('Tuliskan deskripsi singkat tentang dokter. Ditampilkan di modal profil.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                // ── Section 4: Tempat Praktik ──
                Forms\Components\Section::make('Tempat Praktik')
                    ->description('Daftar cabang / klinik tempat dokter ini berpraktik.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Forms\Components\TagsInput::make('practice_locations')
                            ->label('Cabang / Lokasi Praktik')
                            ->placeholder('Ketik nama cabang lalu tekan Enter')
                            ->helperText('Contoh: Ocean Dental Jatiwaringin · Ocean Dental Kartini. Tekan Enter setelah setiap nama cabang.')
                            ->columnSpanFull(),
                    ]),

                // ── Section 5: Pengaturan Tampil ──
                Forms\Components\Section::make('Pengaturan Tampil')
                    ->description('Atur urutan kartu dokter dan visibilitasnya di halaman utama.')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka kecil tampil lebih dulu. Contoh: 1, 2, 3...'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->helperText('Nonaktifkan untuk menyembunyikan dokter ini dari halaman utama.')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width(60),
                Tables\Columns\ImageColumn::make('photo')
                    ->size(60)
                    ->defaultImageUrl(url('/images/no-image.jpg'))
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('university')
                    ->label('Universitas')
                    ->limit(25)
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('years_of_experience')
                    ->label('Pengalaman')
                    ->suffix(' thn')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('badge')
                    ->label('Badge')
                    ->colors([
                        'warning' => 'founder',
                        'primary' => 'specialist',
                    ])
                    ->default('—'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('badge')
                    ->options([
                        'founder'    => 'Founder',
                        'specialist' => 'Specialist',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
