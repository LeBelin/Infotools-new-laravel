<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API routes for rendez vous
//Route::get('/rendez-vous', 'App\Http\Controllers\RendezVousController@index');