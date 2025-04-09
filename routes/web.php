<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\DashboardController;
use App\Models\Produit;

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');



Route::get('/', function () {
    $products = Produit::all();  // Récupère tous les produits
    return view('welcome', compact('products'));  // Passe les produits à la vue
})->name('home');  // Donne un nom à cette route



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::view('prospects', 'prospects')
    ->middleware(['auth', 'verified'])
    ->name('prospects');

    Route::view('commerciaux', 'commerciaux')
    ->middleware(['auth', 'verified'])
    ->name('commerciaux');

    Route::view('clients', 'clients')
    ->middleware(['auth', 'verified'])
    ->name('clients');

    Route::view('produits', 'produits')
    ->middleware(['auth', 'verified'])
    ->name('produits');

    Route::view('commandes', 'commandes')
    ->middleware(['auth', 'verified'])
    ->name('commandes');

    Route::view('factures', 'factures')
    ->middleware(['auth', 'verified'])
    ->name('factures');

    Route::view('rendezvous', 'rendezvous')
    ->middleware(['auth', 'verified'])
    ->name('rendezvous');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
