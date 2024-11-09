<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

Route::get('/note', function (Request $request) {
    return  ["Server" => "Server starting ...."];
});



Route::get('/notes', [ NotesController::class , 'index']);
Route::get('/notes/{id}', [NotesController::class, 'show']);
Route::post('/notes', [NotesController::class, 'store']);
Route::put('/notes/{id}', [NotesController::class, 'update']);
Route::delete('/notes/{id}', [NotesController::class, 'destroy']);
