<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\CustomerResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getTableQuery(): ?Builder
    {
        return $this->getModel()::hasRole(UserRole::CUSTOMER->value);
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('label.all')),
            'verified' => Tab::make(__('label.verified'))
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->whereNotNull('email_verified_at')
                ),
            'not_verified' => Tab::make(__('label.not_verified'))
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->whereNull('email_verified_at')
                ),
        ];
    }
}
