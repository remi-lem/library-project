<?php

namespace App\Filament\Resources\TomeResource\Pages;

use App\Filament\Resources\TomeResource;
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
