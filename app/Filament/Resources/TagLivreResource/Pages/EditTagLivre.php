<?php

namespace App\Filament\Resources\TagLivreResource\Pages;

use App\Filament\Resources\TagLivreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTagLivre extends EditRecord
{
    protected static string $resource = TagLivreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
