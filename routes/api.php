<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('book')
    ->middleware(['auth:sanctum'])
    ->controller(BookController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{book}', 'show');
        Route::post('/', 'store');
        Route::put('/{book}', 'update');
    });
