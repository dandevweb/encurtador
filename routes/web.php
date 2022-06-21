<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('converter', [HomeController::class, 'converter'])->name('url.converter');

Route::get('cliques', [HomeController::class, 'clicks'])->name('url.clicks');

Route::post('cliques', [HomeController::class, 'clicksCount'])->name('clicks.count');

Route::put('cliques', [HomeController::class, 'clicksReset'])->name('clicks.reset');

Route::get('login', [UserController::class, 'index'])->name('user.login');

Route::post('login', [UserController::class, 'login'])->name('login');

Route::get('painel', [DashboardController::class, 'index'])->middleware('auth')->name('painel');

Route::get('{uri}', [RedirectController::class, 'index'])->name('url.redirect');