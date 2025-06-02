<?php

namespace App\Filament\Resources\ServiceUnitResource\Pages;

use App\Filament\Resources\ServiceUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceUnit extends EditRecord
{
    protected static string $resource = ServiceUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
