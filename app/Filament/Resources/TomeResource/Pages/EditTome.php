<?php

namespace App\Filament\Resources\TomeResource\Pages;

use App\Filament\Resources\TomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTome extends EditRecord
{
    protected static string $resource = TomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
