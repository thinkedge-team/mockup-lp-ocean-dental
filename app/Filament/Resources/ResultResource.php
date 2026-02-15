<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Models\Result;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Result Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Pemasangan Veneer, Bleaching & Scaling'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Before & After Images')
                    ->schema([
                        Forms\Components\FileUpload::make('before_image')
                            ->label('Before Image')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '4:3',
                                '3:2',
                                '1:1',
                                '16:9',
                            ])
                            ->directory('results')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                            ->helperText('Upload "before" treatment image. Recommended: 800x600px or higher. Max 5MB.')
                            ->required(),
                        Forms\Components\FileUpload::make('after_image')
                            ->label('After Image')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '4:3',
                                '3:2',
                                '1:1',
                                '16:9',
                            ])
                            ->directory('results')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                            ->helperText('Upload "after" treatment image. Recommended: 800x600px or higher. Max 5MB.')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Description')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->placeholder('e.g., Transformasi senyum dengan veneer porcelain premium')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
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
                Tables\Columns\ImageColumn::make('before_image')
                    ->size(80)
                    ->square()
                    ->defaultImageUrl(url('/images/no-image.jpg'))
                    ->label('Before'),
                Tables\Columns\ImageColumn::make('after_image')
                    ->size(80)
                    ->square()
                    ->defaultImageUrl(url('/images/no-image.jpg'))
                    ->label('After'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResults::route('/'),
            'create' => Pages\CreateResult::route('/create'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }
}
