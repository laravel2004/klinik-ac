<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Enums\PublishStatus;
use App\Filament\Resources\TestimonialResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('label.all')),
            'published' => Tab::make(PublishStatus::PUBLISHED->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_publish', true)
                ),
            'private' => Tab::make(PublishStatus::PRIVATE->getLabel())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_publish', false)
                ),
        ];
    }
}
