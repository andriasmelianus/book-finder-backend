<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public endpoints
Route::prefix('public')
    ->group(function () {
        Route::prefix('book')
            ->controller(BookController::class)
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/search', 'search');
                Route::put('/vote/{book}', 'vote');
            });
    });

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
