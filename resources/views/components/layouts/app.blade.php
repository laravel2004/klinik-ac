<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ ($title ?? null) && url() !== route('home') ? "$title | " . config('app.name') : config('app.name') }}</title>

        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <livewire:components.navbar />

        {{ $slot }}


        <livewire:components.back-to-top />
        <livewire:components.footer />

        @livewireScriptConfig
    </body>
</html>
