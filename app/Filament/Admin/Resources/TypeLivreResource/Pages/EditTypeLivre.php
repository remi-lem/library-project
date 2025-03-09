<?php

namespace App\Filament\Admin\Resources\TypeLivreResource\Pages;

use App\Filament\Admin\Resources\TypeLivreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeLivre extends EditRecord
{
    protected static string $resource = TypeLivreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
