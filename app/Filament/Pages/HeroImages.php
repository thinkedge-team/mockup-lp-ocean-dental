<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class HeroImages extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Hero Images';

    protected static ?string $navigationGroup = 'Hero Section';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.hero-images';

    protected static ?string $title = 'Foto Hero Section';

    // Form state – satu array untuk statePath('data')
    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'hero_image_1' => Setting::get('hero_image_1'),
            'hero_image_2' => Setting::get('hero_image_2'),
            'hero_image_3' => Setting::get('hero_image_3'),
            'hero_image_4' => Setting::get('hero_image_4'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Foto Hero Section')
                    ->description('Upload 4 foto yang akan ditampilkan di kotak hero. Klik foto untuk memperbesar. Ukuran ideal: 600×600px (format persegi).')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('hero_image_1')
                                    ->label('Foto 1 (Kiri Atas)')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('hero')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(5120)
                                    ->helperText('Maks. 5MB · JPG, PNG, WebP · Ideal 600×600px')
                                    ->imagePreviewHeight('220')
                                    ->panelLayout('integrated')
                                    ->uploadingMessage('Mengupload foto 1...')
                                    ->deletable(true),

                                Forms\Components\FileUpload::make('hero_image_2')
                                    ->label('Foto 2 (Kanan Atas)')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('hero')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(5120)
                                    ->helperText('Maks. 5MB · JPG, PNG, WebP · Ideal 600×600px')
                                    ->imagePreviewHeight('220')
                                    ->panelLayout('integrated')
                                    ->uploadingMessage('Mengupload foto 2...')
                                    ->deletable(true),

                                Forms\Components\FileUpload::make('hero_image_3')
                                    ->label('Foto 3 (Kiri Bawah)')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('hero')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(5120)
                                    ->helperText('Maks. 5MB · JPG, PNG, WebP · Ideal 600×600px')
                                    ->imagePreviewHeight('220')
                                    ->panelLayout('integrated')
                                    ->uploadingMessage('Mengupload foto 3...')
                                    ->deletable(true),

                                Forms\Components\FileUpload::make('hero_image_4')
                                    ->label('Foto 4 (Kanan Bawah)')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('hero')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(5120)
                                    ->helperText('Maks. 5MB · JPG, PNG, WebP · Ideal 600×600px')
                                    ->imagePreviewHeight('220')
                                    ->panelLayout('integrated')
                                    ->uploadingMessage('Mengupload foto 4...')
                                    ->deletable(true),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $keys = ['hero_image_1', 'hero_image_2', 'hero_image_3', 'hero_image_4'];

        foreach ($keys as $key) {
            $value = $data[$key] ?? null;

            // FileUpload mengembalikan array saat upload baru, atau string untuk path existing
            if (is_array($value)) {
                $value = reset($value) ?: null;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'image', 'group' => 'hero']
            );
        }

        // Hapus cache settings
        Cache::forget('all_settings');

        Notification::make()
            ->title('Foto hero berhasil disimpan!')
            ->success()
            ->send();
    }
}
