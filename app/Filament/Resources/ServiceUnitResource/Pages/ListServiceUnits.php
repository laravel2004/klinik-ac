<?php

namespace App\Filament\Resources\ServiceUnitResource\Pages;

use App\Filament\Resources\ServiceUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceUnits extends ListRecords
{
    protected static string $resource = ServiceUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
