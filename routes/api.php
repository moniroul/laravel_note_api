<?php

use App\Http\Controllers\NotexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/note', function (Request $request) {
    return  ["Server" => "Server starting ...."];
});
 
Route::get('/notes', [NotexController::class, 'index']);
Route::get('/notes/{id}', [NotexController::class, 'show']);
Route::post('/notes', [NotexController::class, 'store']);
Route::put('/notes/{id}', [NotexController::class, 'update']);
Route::delete('/notes/{id}', [NotexController::class, 'destroy']);
