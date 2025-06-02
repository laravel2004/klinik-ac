<?php

use App\Http\Controllers\Consultan\ConsultanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/diagnosa-ac', [ConsultanController::class, 'diagnosaAc']);
