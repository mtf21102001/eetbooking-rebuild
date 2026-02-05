<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutSettingResource\Pages;
use App\Filament\Resources\AboutSettingResource\RelationManagers;
use App\Models\AboutSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutSettingResource extends Resource
{
  protected static ?string $model = AboutSetting::class;

  protected static ?string $navigationIcon = 'heroicon-o-information-circle';

  protected static ?string $navigationGroup = 'System Management';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('key')
          ->required()
          ->disabled(fn($record) => $record !== null)
          ->unique(ignoreRecord: true),
        Forms\Components\Select::make('type')
          ->options([
            'text' => 'Plain Text',
            'textarea' => 'Long Text',
            'rich_text' => 'Rich Text (HTML)',
            'image' => 'Image (Upload/Link)',
          ])
          ->required()
          ->default('text')
          ->reactive(),
        Forms\Components\TextInput::make('value')
          ->visible(fn($get) => $get('type') === 'text')
          ->columnSpanFull(),
        Forms\Components\Textarea::make('value')
          ->visible(fn($get) => $get('type') === 'textarea')
          ->columnSpanFull(),
        Forms\Components\RichEditor::make('value')
          ->visible(fn($get) => $get('type') === 'rich_text')
          ->columnSpanFull(),
        Forms\Components\FileUpload::make('value')
          ->label('Upload Image')
          ->image()
          ->directory('about')
          ->visibility('public')
          ->visible(fn($get) => $get('type') === 'image')
          ->columnSpanFull(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('key')
          ->searchable(),
        Tables\Columns\TextColumn::make('type')
          ->searchable(),
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
      'index' => Pages\ListAboutSettings::route('/'),
      'create' => Pages\CreateAboutSetting::route('/create'),
      'edit' => Pages\EditAboutSetting::route('/{record}/edit'),
    ];
  }
}
