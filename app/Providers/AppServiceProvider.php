<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentColor::register([
            'primary' => Color::Red,
        ]);

        FilamentView::registerRenderHook(
            PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
            fn (): View => view('filament.components.auth.back-to-landing'),
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::AUTH_REGISTER_FORM_AFTER,
            fn (): View => view('filament.components.auth.back-to-landing'),
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::AUTH_PASSWORD_RESET_REQUEST_FORM_AFTER,
            fn (): View => view('filament.components.auth.back-to-landing'),
        );
    }
}
