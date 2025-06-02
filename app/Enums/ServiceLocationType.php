<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ServiceLocationType: int implements HasLabel, HasColor, HasIcon
{
    case OUTSIDE = 1;
    case INSIDE = 0;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::OUTSIDE => __('label.outside'),
            self::INSIDE => __('label.inside'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OUTSIDE => 'success',
            self::INSIDE => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::OUTSIDE => 'heroicon-o-check-circle',
            self::INSIDE => 'heroicon-o-x-circle',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $case) => [$case->value => $case->getLabel()])
            ->toArray();
    }
}
