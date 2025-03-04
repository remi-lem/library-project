<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TomeResource\Pages;
use App\Models\Tome;
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
                TextInput::make('numero')
                    ->label('Numéro')
                    ->rules([
                        'integer',
                        'min:0',
                    ])
                    ->required()
                    ->numeric(),
                FileUpload::make('couverture')
                    ->image()
                //TODO : corriger l'import d'images en tant que blob
                    /*->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        // Check if the state (file) is not null
                        if ($state) {
                            // Get the uploaded file's real path
                            $image = file_get_contents($state->getRealPath());

                            // Optionally, you can store the image as a BLOB in the database
                            $set('image', $image);
                        } else {
                            $set('image', null); // Make sure to clear it if no file is selected
                        }
                    })*/,
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
                Select::make('idTagLivre')
                    //->multiple()//TODO : autoriser des tags multiples (table a ajouter)
                    ->label('Tags')
                    ->relationship('tagLivre', 'nom')
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('nom')
                            ->label('Nom')
                            ->required()
                            ->unique('TagLivre', 'nom'),
                    ]),

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

                Select::make('idAuteur')
                    ->label('Auteur')
                    ->relationship('Auteur', 'nom')
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
