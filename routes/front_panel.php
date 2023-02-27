<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPanel\AuthController;
use App\Http\Controllers\FrontPanel\RegistrationController;
use App\Http\Controllers\FrontPanel\ForgotPasswordController;
use App\Http\Controllers\FrontPanel\ResetPasswordController;


Route::group(['prefix' => '/login'], function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/authenticate', [AuthController::class, 'authenticate']);
});

Route::group(['prefix' => '/registration'], function () {
    Route::get('/', [RegistrationController::class, 'index']);
    Route::post('/save', [RegistrationController::class, 'save']);
});

Route::get('/forgot-password', [ForgotPasswordController::class, 'index']);
Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verify']);
Route::get('/reset-password/{verification_token}', [ResetPasswordController::class, 'index']);
Route::post('/reset-password/verify', [ResetPasswordController::class, 'verify']);
Route::get('/reset-password/resend', [ResetPasswordController::class, 'resend']);

Route::group(['prefix' => '/control/panel/login'], function () {
    Route::get('/', [AuthController::class, 'controlPanelLogin']);
    Route::post('/authenticate', [AuthController::class, 'authenticateControlPanelLogin']);
});


Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::view('/privacy-policy', 'FrontPanel.privacy_policy', ['title' => 'Privacy Policy']);
Route::view('/terms-of-service', 'FrontPanel.terms_of_service', ['title' => 'Terms of Service']);

