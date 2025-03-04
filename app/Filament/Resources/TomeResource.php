<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TomeResource\Pages;
use App\Filament\Resources\TomeResource\RelationManagers;
use App\Models\Edition;
use App\Models\Tome;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TomeResource extends Resource
{
    protected static ?string $model = Tome::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('ISBN')
                    ->label('ISBN')
                    ->required()
                    ->numeric(),
                TextInput::make('numero')
                    ->label('Numéro')
                    ->required()
                    ->numeric(),
                FileUpload::make('couverture')
                    ->image(),
                DatePicker::make('dateParution')
                    ->label('Date de parution')
                    ->required(),
                Select::make('idEdition')
                    ->label('Édition')
                    ->relationship('edition', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom de l\'édition')
                            ->required(),
                    ])
                    ->required(),
                Select::make('idTypeLivre')
                    ->label('Type de livre')
                    ->relationship('typeLivre', 'nom')
                    ->searchable()
                    ->required(),
                Select::make('idTagLivre')
                    ->multiple()
                    ->label('Tag')
                    ->relationship('tagLivre', 'nom')
                    ->searchable()
                    ->required(),
                Select::make('idGenreLivre')
                    ->label('Genre')
                    ->relationship('genreLivre', 'nom')
                    ->searchable()
                    ->required(),
                Select::make('idAuteur')
                    ->label('Auteur')
                    ->relationship('auteur', 'nom')
                    ->searchable()
                    ->required(),
                Select::make('idEditeur')
                    ->label('Éditeur')
                    ->relationship('editeur', 'nom')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ISBN')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('numero')
                    ->sortable(),
                ImageColumn::make('couverture')
                    ->label('Couverture'),
                TextColumn::make('dateParution')
                    ->sortable(),
                TextColumn::make('edition.nom')
                    ->label('Édition')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('typeLivre.nom')
                    ->label('Type de livre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tagLivre.nom')
                    ->label('Tag')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('genreLivre.nom')
                    ->label('Genre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('auteur.nom')
                    ->label('Auteur')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('editeur.nom')
                    ->label('Éditeur')
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
            'index' => Pages\ListTomes::route('/'),
            'create' => Pages\CreateTome::route('/create'),
            'edit' => Pages\EditTome::route('/{record}/edit'),
        ];
    }
}
