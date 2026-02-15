<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Setting Information')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),

                        Forms\Components\Select::make('group')
                            ->required()
                            ->options([
                                'general' => 'General',
                                'hero' => 'Hero Section',
                                'about' => 'About Section',
                                'stats' => 'Statistics',
                                'contact' => 'Contact Info',
                                'social' => 'Social Media',
                                'seo' => 'SEO',
                            ])
                            ->disabled(),

                        Forms\Components\Select::make('type')
                            ->required()
                            ->options([
                                'text' => 'Text (Short)',
                                'textarea' => 'Textarea (Long)',
                                'number' => 'Number',
                                'email' => 'Email',
                                'url' => 'URL',
                                'image' => 'Image',
                                'boolean' => 'Boolean (Yes/No)',
                            ])
                            ->disabled(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Setting Value')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Value')
                            ->required()
                            ->maxLength(255)
                            ->visible(fn(Forms\Get $get) => in_array($get('type'), ['text', 'email', 'url', 'number']))
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image_value')
                            ->label('Image')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('settings')
                            ->visible(fn(Forms\Get $get) => $get('type') === 'image')
                            ->helperText('Upload an image')
                            ->columnSpanFull(),

                        Forms\Components\Hidden::make('original_image')
                            ->visible(fn(Forms\Get $get) => $get('type') === 'image'),

                        Forms\Components\Textarea::make('textarea_value')
                            ->label('Value')
                            ->required()
                            ->rows(4)
                            ->visible(fn(Forms\Get $get) => $get('type') === 'textarea')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('boolean_value')
                            ->label('Value')
                            ->visible(fn(Forms\Get $get) => $get('type') === 'boolean')
                            ->helperText('Enable or disable this setting')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('value')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();

                        return strlen($state) > 50 ? $state : null;
                    }),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'primary' => 'text',
                        'success' => 'textarea',
                        'warning' => 'number',
                        'danger' => 'boolean',
                        'info' => ['email', 'url', 'image'],
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('group')
                    ->badge()
                    ->colors([
                        'primary' => 'general',
                        'success' => 'hero',
                        'warning' => 'about',
                        'danger' => 'stats',
                        'info' => ['contact', 'social', 'seo'],
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'hero' => 'Hero Section',
                        'about' => 'About Section',
                        'stats' => 'Statistics',
                        'contact' => 'Contact Info',
                        'social' => 'Social Media',
                        'seo' => 'SEO',
                    ])
                    ->multiple(),

                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'number' => 'Number',
                        'email' => 'Email',
                        'url' => 'URL',
                        'image' => 'Image',
                        'boolean' => 'Boolean',
                    ])
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('group', 'asc');
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
            'index' => Pages\ListSettings::route('/'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
