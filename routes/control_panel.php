<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontPanel\AuthController;
use \App\Http\Controllers\ControlPanel\DashboardController;


Route::get('/dashboard', [DashboardController::class, 'index']);


Route::get('/logout', [AuthController::class, 'logoutControlPanel']);


