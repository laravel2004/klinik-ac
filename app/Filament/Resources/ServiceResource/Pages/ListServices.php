<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Enums\ServiceLocationType;
use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('label.all')),
            'inside' => Tab::make(ServiceLocationType::INSIDE->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_outside_area', false)
                ),
            'outside' => Tab::make(ServiceLocationType::OUTSIDE->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_outside_area', true)
                ),
        ];
    }
}
