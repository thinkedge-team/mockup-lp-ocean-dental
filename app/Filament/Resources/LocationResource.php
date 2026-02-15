<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('region_id')
                    ->label('Region')
                    ->relationship('region', 'name')
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('New Region Name')
                            ->required()
                            ->maxLength(100),
                    ])
                    ->createOptionUsing(function ($data) {
                        return \App\Models\Region::create(['name' => $data['name']])->id;
                    })
                    ->helperText('Select or create a region'),
                Forms\Components\TextInput::make('whatsapp')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email(),
                Forms\Components\TextInput::make('latitude')
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->numeric(),
                Forms\Components\Section::make('Weekly Opening Hours')
                    ->description('Set the opening and closing times for each day')
                    ->schema([
                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\Placeholder::make('mon_label')->content('Monday'),
                                Forms\Components\Checkbox::make('schedule.monday.closed')->label('Closed')
                                    ->helperText('Check if the branch is closed this day (times will be ignored)')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $set('schedule.monday.open', null);
                                            $set('schedule.monday.close', null);
                                        }
                                    }),
                                Forms\Components\TimePicker::make('schedule.monday.open')->label('Open')->disabled(fn ($get) => $get('schedule.monday.closed')),
                                Forms\Components\TimePicker::make('schedule.monday.close')->label('Close')->disabled(fn ($get) => $get('schedule.monday.closed')),

                                Forms\Components\Placeholder::make('tue_label')->content('Tuesday'),
                                Forms\Components\Checkbox::make('schedule.tuesday.closed')->label('Closed')
                                    ->helperText('Check if the branch is closed this day (times will be ignored)')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $set('schedule.tuesday.open', null);
                                            $set('schedule.tuesday.close', null);
                                        }
                                    }),
                                Forms\Components\TimePicker::make('schedule.tuesday.open')->label('Open')->disabled(fn ($get) => $get('schedule.tuesday.closed')),
                                Forms\Components\TimePicker::make('schedule.tuesday.close')->label('Close')->disabled(fn ($get) => $get('schedule.tuesday.closed')),

                                Forms\Components\Placeholder::make('wed_label')->content('Wednesday'),
                                Forms\Components\Checkbox::make('schedule.wednesday.closed')->label('Closed')
                                    ->helperText('Check if the branch is closed this day (times will be ignored)')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $set('schedule.wednesday.open', null);
                                            $set('schedule.wednesday.close', null);
                                        }
                                    }),
                                Forms\Components\TimePicker::make('schedule.wednesday.open')->label('Open')->disabled(fn ($get) => $get('schedule.wednesday.closed')),
                                Forms\Components\TimePicker::make('schedule.wednesday.close')->label('Close')->disabled(fn ($get) => $get('schedule.wednesday.closed')),

                                Forms\Components\Placeholder::make('thu_label')->content('Thursday'),
                                Forms\Components\Checkbox::make('schedule.thursday.closed')->label('Closed')
                                    ->helperText('Check if the branch is closed this day (times will be ignored)')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $set('schedule.thursday.open', null);
                                            $set('schedule.thursday.close', null);
                                        }
                                    }),
                                Forms\Components\TimePicker::make('schedule.thursday.open')->label('Open')->disabled(fn ($get) => $get('schedule.thursday.closed')),
                                Forms\Components\TimePicker::make('schedule.thursday.close')->label('Close')->disabled(fn ($get) => $get('schedule.thursday.closed')),

                                Forms\Components\Placeholder::make('fri_label')->content('Friday'),
                                Forms\Components\Checkbox::make('schedule.friday.closed')->label('Closed')
                                    ->helperText('Check if the branch is closed this day (times will be ignored)')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $set('schedule.friday.open', null);
                                            $set('schedule.friday.close', null);
                                        }
                                    }),
                                Forms\Components\TimePicker::make('schedule.friday.open')->label('Open')->disabled(fn ($get) => $get('schedule.friday.closed')),
                                Forms\Components\TimePicker::make('schedule.friday.close')->label('Close')->disabled(fn ($get) => $get('schedule.friday.closed')),

                                Forms\Components\Placeholder::make('sat_label')->content('Saturday'),
                                Forms\Components\Checkbox::make('schedule.saturday.closed')->label('Closed')
                                    ->helperText('Check if the branch is closed this day (times will be ignored)')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $set('schedule.saturday.open', null);
                                            $set('schedule.saturday.close', null);
                                        }
                                    }),
                                Forms\Components\TimePicker::make('schedule.saturday.open')->label('Open')->disabled(fn ($get) => $get('schedule.saturday.closed')),
                                Forms\Components\TimePicker::make('schedule.saturday.close')->label('Close')->disabled(fn ($get) => $get('schedule.saturday.closed')),

                                Forms\Components\Placeholder::make('sun_label')->content('Sunday'),
                                Forms\Components\Checkbox::make('schedule.sunday.closed')->label('Closed')
                                    ->helperText('Check if the branch is closed this day (times will be ignored)')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $set('schedule.sunday.open', null);
                                            $set('schedule.sunday.close', null);
                                        }
                                    }),
                                Forms\Components\TimePicker::make('schedule.sunday.open')->label('Open')->disabled(fn ($get) => $get('schedule.sunday.closed')),
                                Forms\Components\TimePicker::make('schedule.sunday.close')->label('Close')->disabled(fn ($get) => $get('schedule.sunday.closed')),

                            ]),
                    ])
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->label('Region')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schedule')
                    ->label('Weekly Hours')
                    ->formatStateUsing(fn ($record) => collect(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->map(
                        fn ($day) => isset($record->schedule[$day]) ? ucfirst($day).': '.($record->schedule[$day]['open'] ?? '-').' - '.($record->schedule[$day]['close'] ?? '-') : null
                    )->filter()->implode('; ')),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),

                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
