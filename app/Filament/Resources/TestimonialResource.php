<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    
    protected static ?string $navigationGroup = 'Content';
    
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('position')
                            ->maxLength(255)
                            ->placeholder('Profesional, Business Owner, Content Creator, dll.')
                            ->helperText('Occupation or role of the customer (will be displayed on testimonial card)'),
                        Forms\Components\TextInput::make('location')
                            ->maxLength(255)
                            ->placeholder('Jakarta Selatan'),
                        Forms\Components\FileUpload::make('avatar')
                            ->label('Avatar')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                                '3:2',
                                '21:9',
                            ])
                            ->directory('testimonials')
                            ->maxSize(3072)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                            ->helperText('Upload customer avatar. Recommended: 200x200px or higher. Max 3MB.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Review Details')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->required()
                            ->maxLength(1000)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('service_type')
                            ->label('Service Type')
                            ->maxLength(255)
                            ->placeholder('Veneer, Scaling, Behel, etc.'),
                        Forms\Components\Select::make('platform')
                            ->options([
                                'google' => 'Google',
                                'facebook' => 'Facebook',
                                'instagram' => 'Instagram',
                                'website' => 'Website',
                            ])
                            ->default('google')
                            ->required(),
                        Forms\Components\TextInput::make('rating')
                            ->required()
                            ->numeric()
                            ->default(5)
                            ->step(0.5)
                            ->minValue(1)
                            ->maxValue(5),
                        Forms\Components\DateTimePicker::make('review_date')
                            ->label('Review Date')
                            ->default(now()),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('verified')
                            ->label('Verified Review')
                            ->default(true),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required(),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->width(80),
                Tables\Columns\ImageColumn::make('avatar')
                    ->size(60)
                    ->circular()
                    ->defaultImageUrl(url('/images/no-image.jpg'))
                    ->label('Avatar'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->limit(20)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('service_type')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\BadgeColumn::make('platform')
                    ->colors([
                        'danger' => 'google',
                        'primary' => 'facebook',
                        'warning' => 'instagram',
                        'secondary' => 'website',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 1) . ' ⭐'),
                Tables\Columns\IconColumn::make('verified')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('review_date')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('platform')
                    ->options([
                        'google' => 'Google',
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'website' => 'Website',
                    ]),
                Tables\Filters\TernaryFilter::make('verified')
                    ->label('Verified'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
