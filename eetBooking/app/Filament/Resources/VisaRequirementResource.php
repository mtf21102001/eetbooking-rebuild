<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaRequirementResource\Pages;
use App\Filament\Resources\VisaRequirementResource\RelationManagers;
use App\Models\VisaRequirement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisaRequirementResource extends Resource
{
    protected static ?string $model = VisaRequirement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Visa Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('visa_id')
                    ->relationship('visa', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('nationality_id')
                    ->relationship('nationality', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Textarea::make('requirement_details')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('additional_documents')
                    ->schema([
                        Forms\Components\TextInput::make('document')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->grid(2),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('fees')
                            ->numeric()
                            ->prefix('EGP'),
                        Forms\Components\TextInput::make('processing_time')
                            ->maxLength(255),
                    ]),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visa.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nationality.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fees')
                    ->money('EGP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('processing_time')
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVisaRequirements::route('/'),
        ];
    }
}
