<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\TradersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about')->middleware('auth');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile', [ProfileController::class, 'addFunds'])->name('wallet.topUp');

    Route::get('/stocks/search',[StocksController::class,'search'])->middleware('auth')->name('stock.searchByName');
    Route::get('/stocks/{company}/info',[StocksController::class,'view'])->middleware('auth')->name('stock.info');

    Route::post('/buy/stock/{company}/{symbol}/{price}', [StocksController::class, 'buy'])->middleware(['auth', 'verified'])->name('stock.buy');
    Route::post('/sell/{stock}', [StocksController::class, 'sell'])->middleware(['auth', 'verified'])->name('sell.stock');

    Route::get('/transactions', [TradersController::class, 'transactions'])->middleware(['auth', 'verified'])->name('transactions');
    Route::get('/user/portfolio', [StocksController::class, 'portfolio'])->middleware(['auth', 'verified'])->name('portfolio');
});


