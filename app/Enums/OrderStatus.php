<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasLabel, HasColor, HasIcon
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case ONPROGRESS = 'onprogress';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => __('label.pending'),
            self::CONFIRMED => __('label.confirmed'),
            self::ONPROGRESS => __('label.onprogress'),
            self::COMPLETED => __('label.completed'),
            self::CANCELED => __('label.canceled'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::CONFIRMED => 'info',
            self::ONPROGRESS => 'warning',
            self::COMPLETED => 'success',
            self::CANCELED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING => 'heroicon-o-clock',
            self::CONFIRMED => 'heroicon-o-check-circle',
            self::ONPROGRESS => 'heroicon-o-exclamation-triangle',
            self::COMPLETED => 'heroicon-o-check',
            self::CANCELED => 'heroicon-o-x-mark',
        };
    }
}
