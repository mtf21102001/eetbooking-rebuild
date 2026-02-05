<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Service Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Package Components')
                    ->tabs([
                        // Tab 1: Basic Information
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->numeric()
                                            ->required()
                                            ->prefix('EGP'),
                                        Forms\Components\TextInput::make('original_price')
                                            ->numeric()
                                            ->label('Original Price (Before Discount)')
                                            ->prefix('EGP'),
                                        Forms\Components\TextInput::make('discount_percentage')
                                            ->numeric()
                                            ->label('Discount %')
                                            ->suffix('%')
                                            ->maxValue(100),

                                        Forms\Components\TextInput::make('duration_days')
                                            ->label('Duration in Nights')
                                            ->numeric()
                                            ->required()
                                            ->suffix('Nights'),
                                        Forms\Components\TextInput::make('type')
                                            ->label('Package Type')
                                            ->placeholder('e.g. Honeymoon, Adventure')
                                            ->datalist(['Honeymoon', 'Family', 'Adventure', 'Cultural', 'Luxury']) // Suggestions
                                            ->required(),

                                        Forms\Components\TextInput::make('min_people')
                                            ->numeric()
                                            ->default(1)
                                            ->label('Min People'),
                                        Forms\Components\TextInput::make('max_people')
                                            ->numeric()
                                            ->label('Max People'),

                                        Forms\Components\TextInput::make('distance_from_center')
                                            ->numeric()
                                            ->label('Distance (km) from Center/Airport')
                                            ->suffix('km'),

                                        Forms\Components\Select::make('difficulty_level')
                                            ->options([
                                                'Easy' => 'Easy',
                                                'Moderate' => 'Moderate',
                                                'Challenging' => 'Challenging',
                                                'Extreme' => 'Extreme',
                                            ]),
                                        Forms\Components\Select::make('best_season')
                                            ->options([
                                                'Winter' => 'Winter',
                                                'Spring' => 'Spring',
                                                'Summer' => 'Summer',
                                                'Fall' => 'Fall',
                                                'Year-round' => 'Year-round',
                                            ]),
                                    ]),
                                Forms\Components\Select::make('destination_id')
                                    ->relationship('destination', 'name_en')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\Select::make('city_id')
                                            ->relationship('city', 'name_en')
                                            ->required(),
                                        Forms\Components\TextInput::make('name_en')->required(),
                                        Forms\Components\TextInput::make('name_ar')->required(),
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('slug')
                                    ->unique(ignoreRecord: true)
                                    ->required(),
                                Forms\Components\Toggle::make('featured')
                                    ->label('Featured Package')
                                    ->default(false),
                                Forms\Components\Toggle::make('is_offer')
                                    ->label('Special Offer')
                                    ->default(false)
                                    ->live(),
                                Forms\Components\TextInput::make('offer_tag')
                                    ->placeholder('Best Seller')
                                    ->hidden(fn(Forms\Get $get) => !$get('is_offer')),
                                Forms\Components\Toggle::make('is_popular')
                                    ->label('Popular Package')
                                    ->default(false),
                                Forms\Components\TextInput::make('rating')
                                    ->numeric()
                                    ->default(5.00)
                                    ->minValue(1)
                                    ->maxValue(5),
                                Forms\Components\Toggle::make('is_active')
                                    ->default(true),
                            ]),

                        // Tab 2: Translations (Content)
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\Repeater::make('translations')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\Select::make('locale')
                                            ->options(['en' => 'English', 'ar' => 'Arabic'])
                                            ->required()
                                            ->distinct(),
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(
                                                fn($state, callable $set, $get) =>
                                                $get('locale') === 'en' ? $set('../../slug', Str::slug($state)) : null
                                            ),
                                        Forms\Components\Textarea::make('short_description')
                                            ->rows(3),
                                        Forms\Components\RichEditor::make('description')
                                            ->label('Full Description'),
                                        Forms\Components\Repeater::make('itinerary')
                                            ->schema([
                                                Forms\Components\TextInput::make('day_title')->label('Day Title'),
                                                Forms\Components\Textarea::make('day_description')->label('Activities'),
                                            ])
                                            ->collapsible()
                                            ->itemLabel(fn(array $state): ?string => $state['day_title'] ?? null),
                                        Forms\Components\TagsInput::make('inclusions'),
                                        Forms\Components\TagsInput::make('exclusions'),
                                    ])
                                    ->itemLabel(fn(array $state): ?string => match ($state['locale'] ?? '') {
                                        'en' => 'English',
                                        'ar' => 'Arabic',
                                        default => null,
                                    })
                                    ->collapsible()
                                    ->grid(2)
                                    ->defaultItems(2),
                            ]),

                        // Tab 3: Media
                        Forms\Components\Tabs\Tab::make('Media')
                            ->schema([
                                Forms\Components\Repeater::make('media')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\FileUpload::make('url')
                                            ->label('Image')
                                            ->image()
                                            ->directory('packages')
                                            ->required(),
                                        Forms\Components\Toggle::make('is_main')
                                            ->label('Main Image')
                                            ->default(false),
                                    ])
                                    ->grid(4)
                                    ->collapsible(),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('translations.title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('price')
                    ->money('EGP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Duration')
                    ->suffix(' Nights'),
                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
