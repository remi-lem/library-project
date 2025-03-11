<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SerieResource\Pages\CreateSerie;
use App\Filament\Admin\Resources\SerieResource\Pages\EditSerie;
use App\Filament\Admin\Resources\SerieResource\Pages\ListSeries;
use App\Filament\Resources\SerieResource\Pages;
use App\Models\Serie;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SerieResource extends Resource
{
    protected static ?string $model = Serie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
                    ->required()
                    ->maxLength(25),
                Textarea::make('synopsis')
                    ->required()
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('synopsis')
                    ->limit(50)
                    ->sortable(),
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
            'index' => ListSeries::route('/'),
            'create' => CreateSerie::route('/create'),
            'edit' => EditSerie::route('/{record}/edit'),
        ];
    }
}
