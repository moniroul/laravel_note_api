<?php

use App\Http\Controllers\NotexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Server' => 'Server starting ....'];;
});



Route::get('/notes/search', [NotexController::class, 'queryNote']);   
Route::get('/notes', [NotexController::class, 'index']);
Route::get('/notes/{id}', [NotexController::class, 'show']);
Route::post('/notes/add', [NotexController::class, 'store']);
Route::post('/notes-update/{id}', [NotexController::class, 'update']);
Route::delete('/notes/{id}', [NotexController::class, 'destroy']);
