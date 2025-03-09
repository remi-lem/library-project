<?php

namespace App\Filament\Admin\Resources\TypeLivreResource\Pages;

use App\Filament\Admin\Resources\TypeLivreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeLivres extends ListRecords
{
    protected static string $resource = TypeLivreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
