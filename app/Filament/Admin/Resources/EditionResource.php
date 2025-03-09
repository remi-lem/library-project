<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\EditionResource\Pages;
use App\Models\Edition;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EditionResource extends Resource
{
    protected static ?string $model = Edition::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
                    ->required()
                    ->maxLength(25),
                Select::make('idSerie')
                    ->label('Série')
                    ->relationship('serie', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom de la série')
                            ->required(),
                        TextInput::make('synopsis')
                            ->label('Synopsis')
                            ->required(),
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('serie.nom')
                    ->label('Série')
                    ->sortable()
                    ->searchable(),
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
            'index' => \App\Filament\Admin\Resources\EditionResource\Pages\ListEditions::route('/'),
            'create' => \App\Filament\Admin\Resources\EditionResource\Pages\CreateEdition::route('/create'),
            'edit' => \App\Filament\Admin\Resources\EditionResource\Pages\EditEdition::route('/{record}/edit'),
        ];
    }
}
