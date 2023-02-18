<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountPanel\EssayController;


Route::group(['prefix' => '/essay'], function () {
    Route::get('/', [EssayController::class, 'index']);
    Route::post('/write', [EssayController::class, 'write']);
});



