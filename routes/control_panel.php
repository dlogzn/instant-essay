<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontPanel\AuthController;
use \App\Http\Controllers\ControlPanel\DashboardController;
use \App\Http\Controllers\ControlPanel\EssayLogController;


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::group(['prefix' => '/essay/log'], function () {
    Route::get('/', [EssayLogController::class, 'index']);
    Route::get('/fetch/records', [EssayLogController::class, 'fetchRecords']);
});



Route::get('/logout', [AuthController::class, 'logoutControlPanel']);


