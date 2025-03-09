<?php

namespace App\Filament\Admin\Resources\GenreLivreResource\Pages;

use App\Filament\Admin\Resources\GenreLivreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGenreLivre extends EditRecord
{
    protected static string $resource = GenreLivreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
