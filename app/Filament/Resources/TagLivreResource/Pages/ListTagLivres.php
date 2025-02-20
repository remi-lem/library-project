<?php

namespace App\Filament\Resources\TagLivreResource\Pages;

use App\Filament\Resources\TagLivreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTagLivres extends ListRecords
{
    protected static string $resource = TagLivreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
