<?php

namespace App\Filament\Resources\ServiceOrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\ServiceOrderResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListServiceOrders extends ListRecords
{
    protected static string $resource = ServiceOrderResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('label.all')),
            'pending' => Tab::make(OrderStatus::PENDING->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('status', OrderStatus::PENDING)
                ),
            'confirmed' => Tab::make(OrderStatus::CONFIRMED->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('status', OrderStatus::CONFIRMED)
                ),
            'onprogress' => Tab::make(OrderStatus::ONPROGRESS->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('status', OrderStatus::ONPROGRESS)
                ),
            'completed' => Tab::make(OrderStatus::COMPLETED->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('status', OrderStatus::COMPLETED)
                ),
            'canceled' => Tab::make(OrderStatus::CANCELED->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('status', OrderStatus::CANCELED)
                ),
        ];
    }
}
