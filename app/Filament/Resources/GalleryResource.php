<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationGroup = 'Content';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Gallery Item Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->label('Gallery Image')
                            ->image()
                            ->disk('public')
                            ->directory('gallery')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                                '3:2',
                                '21:9', // Ultra-wide panoramic
                            ])
                            ->maxSize(3072)  // 3MB for high-quality gallery images
                            ->helperText('Upload image (max 3MB). Recommended: 1200x800px or higher for best gallery display.')
                            ->columnSpanFull()
                            ->required(),
                    ]),
                    
                Forms\Components\Section::make('Categorization')
                    ->schema([
                        Forms\Components\Select::make('category')
                            ->label('Gallery Category')
                            ->options(function () {
                                // Get existing categories from database
                                $categories = \App\Models\Gallery::whereNotNull('category')
                                    ->distinct()
                                    ->pluck('category', 'category')
                                    ->toArray();

                                // Add default suggestions
                                $defaults = [
                                    'Klinik' => 'Klinik',
                                    'Peralatan' => 'Peralatan',
                                    'Tim' => 'Tim',
                                    'Fasilitas' => 'Fasilitas',
                                    'Acara' => 'Acara',
                                ];

                                return array_merge($defaults, $categories);
                            })
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('category')
                                    ->label('New Category Name')
                                    ->required()
                                    ->maxLength(50)
                                    ->placeholder('e.g., Ruang Tunggu, Perawatan, Workshop'),
                            ])
                            ->createOptionUsing(function ($data) {
                                return $data['category'];
                            })
                            ->required()
                            ->helperText('Select existing category or create a new one inline. Categories help organize gallery items for filtering.'),
                        Forms\Components\Select::make('size')
                            ->options([
                                'normal' => 'Normal',
                                'wide' => 'Wide (2x width)',
                                'tall' => 'Tall (2x height)',
                            ])
                            ->default('normal')
                            ->required()
                            ->helperText('Size determines the masonry layout appearance'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
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
                    ->sortable()
                    ->width(80),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->size(80)
                    ->square()
                    ->defaultImageUrl(asset('images/no-image.jpg'))
                    ->label('Preview'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'klinik',
                        'success' => 'peralatan',
                        'warning' => 'tim',
                    ])
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('size')
                    ->colors([
                        'secondary' => 'normal',
                        'info' => 'wide',
                        'warning' => 'tall',
                    ])
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
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
                        return \App\Models\Gallery::whereNotNull('category')
                            ->distinct()
                            ->pluck('category', 'category')
                            ->toArray();
                    }),
                Tables\Filters\SelectFilter::make('size')
                    ->options([
                        'normal' => 'Normal',
                        'wide' => 'Wide',
                        'tall' => 'Tall',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
