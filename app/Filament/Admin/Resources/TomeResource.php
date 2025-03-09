<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\TomeResource\Pages;
use App\Models\Tome;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    ->numeric()
                    ->maxLength(13)
                    ->required(),
                TextInput::make('titre')
                    ->label('Titre')
                    ->required(),
                Select::make('idEditeur')
                    ->label('Éditeur')
                    ->relationship('Editeur', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom')
                            ->required()
                            ->unique('Editeur', 'nom'),
                    ])
                    ->required(),
                TextInput::make('couverture')
                    ->label('URL de la couverture'),
                Select::make('idAuteur')
                    ->label('Auteur')
                    ->relationship('Auteur', 'nomComplet')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom')
                            ->required(),
                        TextInput::make('prenom')
                            ->label('Prénom')
                            ->required(),
                    ])
                    ->required(),
                Select::make('idGenreLivre')
                    ->label('Genre')
                    ->relationship('GenreLivre', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom')
                            ->required()
                            ->unique('GenreLivre', 'nom'),
                    ])
                    ->required(),
                DatePicker::make('dateParution')
                    ->label('Date de parution')
                    ->required(),
                TextInput::make('numero')
                    ->label('Numéro')
                    ->rules([
                        'integer',
                        'min:0',
                    ])
                    ->required()
                    ->numeric(),
                Select::make('idEdition')
                    ->label('Édition')
                    ->relationship('edition', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom de l\'édition')
                            ->required(),
                        Select::make('idSerie')
                            ->label('Série')
                            ->relationship('serie', 'nom')
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('nom')
                                    ->label('Nom de la série')
                                    ->unique('Serie', 'nom')
                                    ->required(),
                                TextInput::make('synopsis')
                                    ->label('Synopsis')
                                    ->required(),
                            ])
                            ->required(),
                    ]),
                Select::make('idTypeLivre')
                    ->label('Type de livre')
                    ->relationship('typeLivre', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom')
                            ->required()
                            ->unique('TypeLivre', 'nom'),
                    ])
                    ->required(),
                Select::make('tags')
                    ->multiple()
                    ->label('Tags')
                    ->relationship('tags', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom')
                            ->required()
                            ->unique('Tag', 'nom'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ISBN')
                    ->label('ISBN')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('titre')
                    ->label('Titre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('editeur.nom')
                    ->label('Éditeur')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('couverture')
                    ->label('Couverture'),
                TextColumn::make('auteur.nomComplet')
                    ->label('Auteur')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('genreLivre.nom')
                    ->label('Genre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('dateParution')
                    ->sortable(),
                TextColumn::make('numero')
                    ->label("Numéro")
                    ->sortable(),
                TextColumn::make('edition.nom')
                    ->label('Édition')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('typeLivre.nom')
                    ->label('Type de livre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tags.nom')
                    ->label('Tags')
                    ->sortable()
                    ->badge()
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
            'index' => \App\Filament\Admin\Resources\TomeResource\Pages\ListTomes::route('/'),
            'create' => \App\Filament\Admin\Resources\TomeResource\Pages\CreateTome::route('/create'),
            'edit' => \App\Filament\Admin\Resources\TomeResource\Pages\EditTome::route('/{record}/edit'),
        ];
    }
}
