<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');
Route::get('/services', \App\Livewire\Service::class)->name('services.index');
Route::get('/services/{slug}', \App\Livewire\ViewService::class)->name('services.show');

Route::middleware(['customer.auth'])->group(function () {
    Route::get('/services/{slug}/order', \App\Livewire\OrderService::class)->name('services.order');
});
