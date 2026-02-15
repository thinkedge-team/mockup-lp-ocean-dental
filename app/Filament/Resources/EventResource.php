<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->helperText('Full event description with formatting. Use bold, lists, headings, and links to create engaging content.')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),
                Forms\Components\Textarea::make('short_description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Event Image')
                    ->image()
                    ->disk('public')
                    ->directory('events')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(2048)
                    ->helperText('Upload event image (max 2MB). Recommended size: 1600x800px for best display.')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date'),
                Forms\Components\TextInput::make('location')
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\Select::make('category')
                    ->label('Event Category')
                    ->options(function () {
                        // Get existing categories from database
                        $categories = \App\Models\Event::whereNotNull('category')
                            ->distinct()
                            ->pluck('category', 'category')
                            ->toArray();

                        // Add default suggestions
                        $defaults = [
                            'Community' => 'Community',
                            'Seminar' => 'Seminar',
                            'Workshop' => 'Workshop',
                            'Promo' => 'Promo',
                            'Dental Camp' => 'Dental Camp',
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
                    ->helperText('Select existing category or create a new one inline. Categories help organize events and improve filtering.'),
                Forms\Components\TextInput::make('max_participants')
                    ->numeric(),
                Forms\Components\TextInput::make('registered_participants')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\Textarea::make('benefits')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('requirements')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('registration_url'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp')
                    ->placeholder('150000')
                    ->helperText('Enter price in Rupiah (e.g., 150000 for Rp 150K, or 0 for free events)'),
                Forms\Components\KeyValue::make('meta_tags')
                    ->label('SEO Meta Tags')
                    ->helperText('Add SEO meta tags for search engines and social media. Examples: description: "Join our free dental camp event" (150-160 chars) | keywords: "dental checkup, free event, jakarta" | og:title: "Free Dental Camp - Ocean Dental" | og:description: "Get free dental checkup for 100 participants" | twitter:card: "summary_large_image"')
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->size(60)
                    ->defaultImageUrl(asset('images/no-image.jpg')),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_participants')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registered_participants')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('registration_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
