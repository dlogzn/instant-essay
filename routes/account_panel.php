<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountPanel\EssayController;
use App\Http\Controllers\FrontPanel\AuthController;


Route::group(['prefix' => '/essay'], function () {
    Route::get('/', [EssayController::class, 'index']);
    Route::post('/write', [EssayController::class, 'write']);
});


Route::get('/logout', [AuthController::class, 'logout']);


