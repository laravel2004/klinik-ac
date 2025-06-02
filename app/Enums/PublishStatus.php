<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PublishStatus: int implements HasLabel, HasColor, HasIcon
{
    case PUBLISHED = 1;
    case PRIVATE = 0;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PUBLISHED => __('label.published'),
            self::PRIVATE => __('label.private'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PUBLISHED => 'success',
            self::PRIVATE => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PUBLISHED => 'heroicon-o-check-circle',
            self::PRIVATE => 'heroicon-o-x-circle',
        };
    }
}
