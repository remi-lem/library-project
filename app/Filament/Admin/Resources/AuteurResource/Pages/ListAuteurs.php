<?php

namespace App\Filament\Admin\Resources\AuteurResource\Pages;

use App\Filament\Admin\Resources\AuteurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAuteurs extends ListRecords
{
    protected static string $resource = AuteurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
