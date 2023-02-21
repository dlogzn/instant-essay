<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPanel\AuthController;

Route::group(['prefix' => '/login'], function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/authenticate', [AuthController::class, 'authenticate']);
});

Route::group(['prefix' => '/control/panel/login'], function () {
    Route::get('/', [AuthController::class, 'controlPanelLogin']);
    Route::post('/authenticate', [AuthController::class, 'authenticateControlPanelLogin']);
});



Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);





Route::view('/privacy-policy', 'FrontPanel.privacy_policy', ['title' => 'Privacy Policy']);
Route::view('/terms-of-service', 'FrontPanel.terms_of_service', ['title' => 'Terms of Service']);

