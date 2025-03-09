<?php

namespace App\Filament\Admin\Resources\AuteurResource\Pages;

use App\Filament\Admin\Resources\AuteurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAuteur extends EditRecord
{
    protected static string $resource = AuteurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
