<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TypeLivreResource\Pages\CreateTypeLivre;
use App\Filament\Admin\Resources\TypeLivreResource\Pages\EditTypeLivre;
use App\Filament\Admin\Resources\TypeLivreResource\Pages\ListTypeLivres;
use App\Filament\Resources\TypeLivreResource\Pages;
use App\Models\TypeLivre;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TypeLivreResource extends Resource
{
    protected static ?string $model = TypeLivre::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

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
            'index' => ListTypeLivres::route('/'),
            'create' => CreateTypeLivre::route('/create'),
            'edit' => EditTypeLivre::route('/{record}/edit'),
        ];
    }
}
