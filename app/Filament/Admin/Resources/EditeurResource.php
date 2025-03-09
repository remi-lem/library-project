<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\EditeurResource\Pages;
use App\Models\Editeur;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EditeurResource extends Resource
{
    protected static ?string $model = Editeur::class;

    protected static ?string $navigationIcon = 'heroicon-o-printer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
                    ->required()
                    ->maxLength(25),
                TextInput::make('imgPattern')
                    ->label("Pattern URL des images de couverture")
                    ->hint("Remplacez l'ISBN par <IMG>.")
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('imgPattern')
                    ->label("Pattern URL de couverture"),
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
            'index' => \App\Filament\Admin\Resources\EditeurResource\Pages\ListEditeurs::route('/'),
            'create' => \App\Filament\Admin\Resources\EditeurResource\Pages\CreateEditeur::route('/create'),
            'edit' => \App\Filament\Admin\Resources\EditeurResource\Pages\EditEditeur::route('/{record}/edit'),
        ];
    }
}
