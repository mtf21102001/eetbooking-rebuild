<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaResource\Pages;
use App\Filament\Resources\VisaResource\RelationManagers;
use App\Models\Visa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisaResource extends Resource
{
    protected static ?string $model = Visa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Visa Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('destination_id')
                    ->relationship('destination', 'name_en')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->directory('visas'),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('EGP'),
                        Forms\Components\TextInput::make('currency')
                            ->default('EGP')
                            ->required(),
                        Forms\Components\TextInput::make('processing_time')
                            ->maxLength(255),
                    ]),
                Forms\Components\Repeater::make('required_documents')
                    ->schema([
                        Forms\Components\TextInput::make('document')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->grid(2),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('validity_period')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('entry_type')
                            ->maxLength(255),
                    ]),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('destination.name_en')
                    ->label('Destination')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('EGP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
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
            'index' => Pages\ListVisas::route('/'),
            'create' => Pages\CreateVisa::route('/create'),
            'edit' => Pages\EditVisa::route('/{record}/edit'),
        ];
    }
}
