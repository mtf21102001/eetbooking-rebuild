<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransferBookingResource\Pages;
use App\Filament\Resources\TransferBookingResource\RelationManagers;
use App\Models\TransferBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransferBookingResource extends Resource
{
    protected static ?string $model = TransferBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

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
                Forms\Components\Section::make('Trip Details')
                    ->schema([
                        Forms\Components\TextInput::make('pickup_location')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('dropoff_location')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('pickup_date')
                            ->required(),
                        Forms\Components\TimePicker::make('pickup_time'),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('passengers')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                Forms\Components\Select::make('vehicle_type')
                                    ->options([
                                        'Standard' => 'Standard (Sedan)',
                                        'Van' => 'Van (4-6 pax)',
                                        'Bus' => 'Bus (7+ pax)',
                                    ]),
                            ]),
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
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Customer')
                    ->formatStateUsing(fn($record) => $record->first_name . ' ' . $record->last_name)
                    ->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->icon('heroicon-m-phone'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pickup_location')
                    ->searchable()
                    ->label('Route')
                    ->formatStateUsing(fn($record) => $record->pickup_location . ' → ' . $record->dropoff_location)
                    ->wrap(),
                Tables\Columns\TextColumn::make('pickup_date')
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('whatsapp')
                        ->label('WhatsApp')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->color('success')
                        ->url(fn($record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->phone), shouldOpenInNewTab: true),
                    Tables\Actions\Action::make('call')
                        ->label('Call')
                        ->icon('heroicon-o-phone')
                        ->url(fn($record) => 'tel:' . $record->phone),
                    Tables\Actions\Action::make('email')
                        ->label('Email')
                        ->icon('heroicon-o-envelope')
                        ->url(fn($record) => 'mailto:' . $record->email),
                ]),
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
            'index' => Pages\ListTransferBookings::route('/'),
            'create' => Pages\CreateTransferBooking::route('/create'),
            'edit' => Pages\EditTransferBooking::route('/{record}/edit'),
        ];
    }
}
