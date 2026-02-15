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
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('position')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('university')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('bio')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Photo & Badge')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                                '3:2',
                                '21:9',
                            ])
                            ->directory('team-members')
                            ->maxSize(3072)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                            ->helperText('Upload doctor photo. Recommended: 400x400px or higher. Max 3MB.')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('badge')
                            ->options([
                                'founder' => 'Founder',
                                'specialist' => 'Specialist',
                            ])
                            ->nullable(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'online' => 'Online',
                                'busy' => 'Busy',
                                'offline' => 'Offline',
                            ])
                            ->default('offline')
                            ->required(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Professional Details')
                    ->schema([
                        Forms\Components\TextInput::make('specialization')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('years_of_experience')
                            ->numeric()
                            ->suffix('years'),
                        Forms\Components\KeyValue::make('qualifications')
                            ->label('Qualifications')
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('expertise_tags')
                            ->label('Expertise Tags')
                            ->placeholder('Enter expertise areas')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Statistics')
                    ->schema([
                        Forms\Components\TextInput::make('rating')
                            ->numeric()
                            ->default(5.0)
                            ->step(0.1)
                            ->minValue(0)
                            ->maxValue(5),
                        Forms\Components\TextInput::make('review_count')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('patient_count')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Social Links')
                    ->description('Enter social media profile URLs (leave empty to hide)')
                    ->schema([
                        Forms\Components\TextInput::make('social_links.instagram')
                            ->label('Instagram URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('instagram.com/username')
                            ->helperText('Example: https://instagram.com/drg.aersy'),
                        Forms\Components\TextInput::make('social_links.linkedin')
                            ->label('LinkedIn URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('linkedin.com/in/username')
                            ->helperText('Example: https://linkedin.com/in/drg-aersy'),
                        Forms\Components\TextInput::make('social_links.facebook')
                            ->label('Facebook URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('facebook.com/username')
                            ->helperText('Example: https://facebook.com/drg.aersy'),
                        Forms\Components\TextInput::make('social_links.twitter')
                            ->label('Twitter URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('twitter.com/username')
                            ->helperText('Example: https://twitter.com/drg_aersy'),
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
                Tables\Columns\ImageColumn::make('photo')
                    ->size(80)
                    ->defaultImageUrl(url('/images/no-image.jpg'))
                    ->label('Photo'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->limit(25),
                Tables\Columns\BadgeColumn::make('badge')
                    ->colors([
                        'warning' => 'founder',
                        'success' => 'specialist',
                    ])
                    ->default('—'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'online',
                        'warning' => 'busy',
                        'danger' => 'offline',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 1)),
                Tables\Columns\TextColumn::make('patient_count')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state)),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('badge')
                    ->options([
                        'founder' => 'Founder',
                        'specialist' => 'Specialist',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'online' => 'Online',
                        'busy' => 'Busy',
                        'offline' => 'Offline',
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
