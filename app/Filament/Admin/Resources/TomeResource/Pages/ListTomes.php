<?php

namespace App\Filament\Admin\Resources\TomeResource\Pages;

use App\Filament\Admin\Resources\TomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTomes extends ListRecords
{
    protected static string $resource = TomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
