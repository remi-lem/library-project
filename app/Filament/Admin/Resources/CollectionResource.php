<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CollectionResource\Pages\CreateCollection;
use App\Filament\Admin\Resources\CollectionResource\Pages\EditCollection;
use App\Filament\Admin\Resources\CollectionResource\Pages\ListCollections;
use App\Filament\Resources\CollectionResource\Pages;
use App\Models\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ISBN')
                    ->label('Tome')
                    ->relationship('tome', 'titre')
                    ->searchable()
                    ->required(),

                Select::make('id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tome.titre')
                    ->label('Tome')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Utilisateur')
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
            'index' => ListCollections::route('/'),
            'create' => CreateCollection::route('/create'),
            'edit' => EditCollection::route('/{record}/edit'),
        ];
    }
}
