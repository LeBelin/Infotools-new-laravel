<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::view('clients', 'clients')
    ->middleware(['auth', 'verified'])
    ->name('clients');


    Route::view('Prospects', 'prospects')
    ->middleware(['auth', 'verified'])
    ->name('prospects');

    Route::view('Commerciaux', 'commerciaux')
    ->middleware(['auth', 'verified'])
    ->name('commerciaux');

    Route::view('Produits', 'produits')
    ->middleware(['auth', 'verified'])
    ->name('produits');

    Route::view('Commande', 'commande')
    ->middleware(['auth', 'verified'])
    ->name('commande');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
