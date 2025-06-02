<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Gender: string implements HasLabel, HasColor
{
    case MALE = 'male';
    case FEMALE = 'female';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MALE => __('label.male'),
            self::FEMALE => __('label.female'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::MALE => Color::Blue,
            self::FEMALE => Color::Pink,
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $case) => [$case->value => $case->getLabel()])
            ->toArray();
    }
}
