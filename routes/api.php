<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\CommerciauxApiController;
use App\Http\Controllers\RendezVousApiController;

Route::post('login', [ApiController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('rendezvous', RendezVousApiController::class);
});

//Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('commerciaux', CommerciauxApiController::class);
//});


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



//Route::post('register', [ApiController::class, 'register']);




//Route::middleware(['auth:sanctum' => ["auth:sanctum"] ], function() {
//    Route::get('rendezvous', [ApiController::class, 'rendezvous']);
//});
