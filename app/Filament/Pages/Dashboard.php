<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BasePage
{
    public function getTitle(): string|Htmlable
    {
        return __('label.dashboard');
    }

    public static function getNavigationLabel(): string
    {
        return __('label.dashboard');
    }
}
