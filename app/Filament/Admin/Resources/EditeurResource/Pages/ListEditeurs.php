<?php

namespace App\Filament\Admin\Resources\EditeurResource\Pages;

use App\Filament\Admin\Resources\EditeurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEditeurs extends ListRecords
{
    protected static string $resource = EditeurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
