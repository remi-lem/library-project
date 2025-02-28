<?php

namespace App\Filament\Resources\EditeurResource\Pages;

use App\Filament\Resources\EditeurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEditeur extends EditRecord
{
    protected static string $resource = EditeurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
