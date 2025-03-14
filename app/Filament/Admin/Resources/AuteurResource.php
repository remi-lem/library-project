<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AuteurResource\Pages\CreateAuteur;
use App\Filament\Admin\Resources\AuteurResource\Pages\EditAuteur;
use App\Filament\Admin\Resources\AuteurResource\Pages\ListAuteurs;
use App\Filament\Resources\AuteurResource\Pages;
use App\Models\Auteur;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AuteurResource extends Resource
{
    protected static ?string $model = Auteur::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
                    ->required()
                    ->maxLength(25),
                TextInput::make('prenom')
                    ->required()
                    ->maxLength(25),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('prenom')
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
            'index' => ListAuteurs::route('/'),
            'create' => CreateAuteur::route('/create'),
            'edit' => EditAuteur::route('/{record}/edit'),
        ];
    }
}
