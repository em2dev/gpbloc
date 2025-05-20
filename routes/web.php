<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', function () {

    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canResetPassword' => Route::has('password.reset'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/quotes/show', function () {
        return Inertia::render('Quotes/Show');
    })->name('quotes.show');

    Route::get('/quotes/create', function () {
        return Inertia::render('Quotes/Create');
    })->name('quotes.create');

    Route::get('/quotes/edit/{id}', 'App\Http\Controllers\Quotes\QuoteController@edit')->name('quote.edit');

    Route::get('/teamClients/get', 'App\Http\Controllers\TeamClientController@get')->name('teamClients.get');
});
