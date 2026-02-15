<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category')
                            ->label('Category')
                            ->options(function () {
                                // Get existing categories from database
                                $categories = \App\Models\Service::whereNotNull('category')
                                    ->distinct()
                                    ->pluck('category', 'category')
                                    ->toArray();

                                // Add default suggestions
                                $defaults = [
                                    'Estetika' => 'Estetika',
                                    'Perawatan' => 'Perawatan',
                                    'Ortodonti' => 'Ortodonti',
                                ];

                                return array_merge($defaults, $categories);
                            })
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('category')
                                    ->label('New Category Name')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->createOptionUsing(function ($data) {
                                return $data['category'];
                            })
                            ->nullable()
                            ->helperText('Select existing or create new category'),
                        Forms\Components\Select::make('badge')
                            ->options([
                                'popular' => 'Popular',
                                'recommended' => 'Recommended',
                                'new' => 'New',
                                'promo' => 'Promo',
                            ])
                            ->searchable()
                            ->nullable()
                            ->helperText('Optional badge to highlight this service'),
                        Forms\Components\Textarea::make('short_description')
                            ->label('Short Description')
                            ->maxLength(200)
                            ->helperText('Displayed on homepage cards (max 200 chars)')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->helperText('Full description displayed on detail page')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->maxLength(255)
                            ->placeholder('fas fa-tooth')
                            ->helperText('Font Awesome icon class'),
                        Forms\Components\FileUpload::make('image')
                            ->label('Service Image')
                            ->image()
                            ->disk('public')
                            ->directory('services')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->helperText('Upload image (max 2MB). If empty, dental icon placeholder will be shown.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price_start')
                            ->label('Starting Price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('1500000')
                            ->helperText('Enter price in Rupiah (e.g., 1500000 for Rp 1.5jt)'),
                        Forms\Components\TextInput::make('price_end')
                            ->label('Ending Price (Optional)')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('4000000')
                            ->helperText('Leave empty if price is "starting from". Will show as range if filled.')
                            ->nullable(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Duration')
                    ->schema([
                        Forms\Components\Select::make('duration_type')
                            ->label('Duration Type')
                            ->options([
                                'waktu' => 'Waktu (Jam/Menit)',
                                'kunjungan' => 'Jumlah Kunjungan',
                            ])
                            ->default('waktu')
                            ->required()
                            ->live()
                            ->helperText('Choose whether duration is time-based or visit-based'),
                        Forms\Components\TextInput::make('duration')
                            ->label(fn($get) => $get('duration_type') === 'kunjungan' ? 'Number of Visits' : 'Duration')
                            ->placeholder(fn($get) => $get('duration_type') === 'kunjungan' ? 'e.g., 2-3' : 'e.g., 30-45 menit, 1-2 jam')
                            ->helperText(fn($get) => $get('duration_type') === 'kunjungan'
                                ? 'Enter number of visits (e.g., 2-3, 5-6)'
                                : 'Enter time duration (e.g., 30-45 menit, 1-2 jam, Sekitar 1 jam)')
                            ->nullable(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Display Order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required()
                            ->helperText('Show on website when enabled'),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false)
                            ->required()
                            ->helperText('Mark as featured/popular service'),
                    ])
                    ->columns(3),
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
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->width(80)
                    ->height(60)
                    ->defaultImageUrl(url('/images/no-image.jpg')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->limit(30)
                    ->weight('bold'),
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => fn($state) => $state === 'Estetika',
                        'success' => fn($state) => $state === 'Perawatan',
                        'warning' => fn($state) => $state === 'Ortodonti',
                        'secondary' => fn($state) => !in_array($state, ['Estetika', 'Perawatan', 'Ortodonti']),
                    ])
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('badge')
                    ->colors([
                        'danger' => 'popular',
                        'info' => 'recommended',
                        'success' => 'new',
                        'warning' => 'promo',
                    ])
                    ->formatStateUsing(fn($state) => $state ? ucfirst($state) : '—')
                    ->sortable(),
                Tables\Columns\TextColumn::make('formatted_price')
                    ->label('Price Range')
                    ->searchable(false)
                    ->sortable(false),
                Tables\Columns\TextColumn::make('formatted_duration')
                    ->label('Duration')
                    ->limit(20)
                    ->searchable(false),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(function () {
                        return \App\Models\Service::whereNotNull('category')
                            ->distinct()
                            ->pluck('category', 'category')
                            ->toArray();
                    })
                    ->searchable(),
                Tables\Filters\SelectFilter::make('badge')
                    ->options([
                        'popular' => 'Popular',
                        'recommended' => 'Recommended',
                        'new' => 'New',
                        'promo' => 'Promo',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
