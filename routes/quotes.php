<?php

use App\Http\Controllers\Quotes\QuoteClientController;
use App\Http\Controllers\Quotes\QuoteController;
use App\Http\Controllers\Quotes\QuoteNoteController;
use App\Http\Controllers\Quotes\QuoteOptionController;
use App\Http\Controllers\Quotes\QuoteOptionItemController;
use App\Http\Controllers\Quotes\QuoteProductController;
use App\Http\Controllers\Quotes\QuoteProductItemController;
use App\Http\Controllers\Quotes\QuoteTransportationController;
use App\Http\Controllers\Quotes\QuoteTransportationItemController;
use App\Http\Controllers\Quotes\QuoteTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(QuoteController::class)->name('quote.')->group(function () {
        Route::get('/quote/get', 'get')->name('get');
        Route::get('/quote/show', 'show')->name('show');
        Route::post('/quote/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteTypeController::class)->name('quote_type.')->group(function () {
        Route::get('/quote_type/get', 'get')->name('get');
        Route::post('/quote_type/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_type/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteClientController::class)->name('quote_client.')->group(function () {
        Route::post('/quote_client/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_client/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteProductController::class)->name('quote_product.')->group(function () {
        Route::post('/quote_product/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_product/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteProductItemController::class)->name('quote_product_item.')->group(function () {
        Route::post('/quote_product_item/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_product_item/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteTransportationController::class)->name('quote_transportation.')->group(function () {
        Route::post('/quote_transportation/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_transportation/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteTransportationItemController::class)->name('quote_transportation_item.')->group(function () {
        Route::post('/quote_transportation_item/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_transportation_item/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteOptionController::class)->name('quote_option.')->group(function () {
        Route::post('/quote_option/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_option/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteOptionItemController::class)->name('quote_option_item.')->group(function () {
        Route::post('/quote_option_item/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_option_item/delete/{id}', 'destroy')->name('delete');
    });
    Route::controller(QuoteNoteController::class)->name('quote_note.')->group(function () {
        Route::post('/quote_note/updateOrCreate', 'updateOrCreate')->name('updateOrCreate');
        Route::delete('/quote_note/delete/{id}', 'destroy')->name('delete');
    });
});
