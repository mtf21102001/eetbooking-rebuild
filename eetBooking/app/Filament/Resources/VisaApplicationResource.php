<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaApplicationResource\Pages;
use App\Filament\Resources\VisaApplicationResource\RelationManagers;
use App\Models\VisaApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisaApplicationResource extends Resource
{
    protected static ?string $model = VisaApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Visa Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('application_reference')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(false)
                    ->placeholder('Auto-generated on save'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('visa_id')
                            ->relationship('visa', 'title')
                            ->required(),
                        Forms\Components\Select::make('nationality_id')
                            ->relationship('nationality', 'name')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Personal Information')
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
                Forms\Components\Section::make('Travel Details')
                    ->schema([
                        Forms\Components\TextInput::make('passport_number')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('passport_expiry')
                            ->required(),
                        Forms\Components\TextInput::make('occupation')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('monthly_income')
                            ->numeric(),
                    ])->columns(2),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'approved' => 'Approved',
                        'denied' => 'Denied',
                    ])
                    ->default('pending')
                    ->required(),
                Forms\Components\Textarea::make('admin_notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('application_reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('visa.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nationality.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'approved' => 'success',
                        'denied' => 'danger',
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
            'index' => Pages\ListVisaApplications::route('/'),
            'create' => Pages\CreateVisaApplication::route('/create'),
            'edit' => Pages\EditVisaApplication::route('/{record}/edit'),
        ];
    }
}
