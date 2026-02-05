<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightBookingResource\Pages;
use App\Filament\Resources\FlightBookingResource\RelationManagers;
use App\Models\FlightBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightBookingResource extends Resource
{
    protected static ?string $model = FlightBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Booking Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('booking_reference')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(false)
                    ->placeholder('Auto-generated on save'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
                Forms\Components\Section::make('Flight Details')
                    ->schema([
                        Forms\Components\TextInput::make('departure_city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('arrival_city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('departure_date')
                            ->required(),
                        Forms\Components\DatePicker::make('return_date'),
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('adults')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('children')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('infants')
                                    ->numeric()
                                    ->default(0),
                            ]),
                        Forms\Components\Select::make('class_preference')
                            ->options([
                                'economy' => 'Economy',
                                'business' => 'Business',
                                'first' => 'First',
                            ])
                            ->default('economy')
                            ->required(),
                    ])->columns(2),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departure_city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('arrival_city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departure_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListFlightBookings::route('/'),
            'create' => Pages\CreateFlightBooking::route('/create'),
            'edit' => Pages\EditFlightBooking::route('/{record}/edit'),
        ];
    }
}
