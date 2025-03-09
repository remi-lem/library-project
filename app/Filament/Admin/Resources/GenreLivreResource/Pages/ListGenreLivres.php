<?php

namespace App\Filament\Admin\Resources\GenreLivreResource\Pages;

use App\Filament\Admin\Resources\GenreLivreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGenreLivres extends ListRecords
{
    protected static string $resource = GenreLivreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
