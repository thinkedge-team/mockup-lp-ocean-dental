<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocMedPlatformResource\Pages;
use App\Models\SocMedPlatform;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Config;

class SocMedPlatformResource extends Resource
{
    protected static ?string $model = SocMedPlatform::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Platform')
                    ->schema([
                        Forms\Components\TextInput::make('platform')
                            ->required()
                            ->disabled()
                            ->helperText('Platform is predefined and cannot be changed'),
                    ]),

                Forms\Components\Section::make('Configuration')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Instagram, YouTube, Facebook'),
                        Forms\Components\TextInput::make('value')
                            ->required()
                            ->placeholder(function (Forms\Get $get) {
                                $platform = $get('platform');
                                if (! $platform) {
                                    return 'Enter URL or phone number';
                                }
                                $config = Config::get('social_platforms.platforms.'.$platform, []);

                                return $config['type'] === 'phone' ? 'e.g., 62812345678' : 'e.g., https://instagram.com/yourprofile';
                            })
                            ->helperText(function (Forms\Get $get) {
                                $platform = $get('platform');
                                if (! $platform) {
                                    return '';
                                }
                                $config = Config::get('social_platforms.platforms.'.$platform, []);

                                return $config['type'] === 'phone' ? 'Enter phone number with country code (without + or dashes)' : 'Enter the full URL to your profile';
                            }),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Display')
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
                Tables\Columns\TextColumn::make('platform')
                    ->label('Platform')
                    ->formatStateUsing(function ($state) {
                        $config = Config::get('social_platforms.platforms.'.$state, []);
                        $color = $config['color'] ?? '#6b7280';

                        return '<span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: '.($config['bg_color'] ?? 'rgba(0,0,0,0.1)').'; border-radius: 6px; font-size: 12px; font-weight: 600; color: '.$color.';"><i class="'.($config['icon'] ?? 'fas fa-globe').'"></i> '.ucfirst($state).'</span>';
                    })
                    ->html()
                    ->width(140),
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('value')
                    ->limit(40)
                    ->placeholder('Not set'),
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
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocMedPlatforms::route('/'),
            'edit' => Pages\EditSocMedPlatform::route('/{record}/edit'),
        ];
    }
}
