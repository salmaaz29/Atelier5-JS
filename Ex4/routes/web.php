<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

Route::resource('stocks', StockController::class);
Route::get('/stocks/data', [StockController::class, 'chartData'])->name('stocks.data');

Route::get('/', function () {
    return view('welcome');
});
