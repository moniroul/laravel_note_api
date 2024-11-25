<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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


    // new route add

    Route::post('/user/basic-info', [UserController::class, 'storeBasicInfo']);

    Route::post('/posts/add', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
    
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);

    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/tags', [TagController::class, 'store']);
});
