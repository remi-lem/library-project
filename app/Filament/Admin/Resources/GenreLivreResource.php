<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GenreLivreResource\Pages\CreateGenreLivre;
use App\Filament\Admin\Resources\GenreLivreResource\Pages\EditGenreLivre;
use App\Filament\Admin\Resources\GenreLivreResource\Pages\ListGenreLivres;
use App\Filament\Resources\GenreLivreResource\Pages;
use App\Models\GenreLivre;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GenreLivreResource extends Resource
{
    protected static ?string $model = GenreLivre::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
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
            'index' => ListGenreLivres::route('/'),
            'create' => CreateGenreLivre::route('/create'),
            'edit' => EditGenreLivre::route('/{record}/edit'),
        ];
    }
}
