<?php

namespace App\Filament\Resources\ServiceUnitResource\Pages;

use App\Filament\Resources\ServiceUnitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceUnit extends CreateRecord
{
    protected static string $resource = ServiceUnitResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }
}
