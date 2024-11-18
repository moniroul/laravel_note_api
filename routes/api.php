<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotexController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Server' => 'Server starting ....'];;
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware([CheckApiToken::class])->group(function () {

    // Authentication
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);



    Route::get('/notes/search', [NotexController::class, 'queryNote']);
    Route::get('/notes', [NotexController::class, 'index']);
    Route::get('/notes/{id}', [NotexController::class, 'show']);
    Route::post('/notes/add', [NotexController::class, 'store']);
    Route::post('/notes-update/{id}', [NotexController::class, 'update']);
    Route::delete('/notes/{id}', [NotexController::class, 'destroy']);



});
