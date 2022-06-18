<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('converter', [HomeController::class, 'converter'])->name('url.converter');

Route::get('cliques', [HomeController::class, 'clicks'])->name('url.clicks');

Route::post('cliques', [HomeController::class, 'clicksCount'])->name('clicks.count');

Route::put('cliques', [HomeController::class, 'clicksReset'])->name('clicks.reset');