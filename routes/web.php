<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CurrencyConversionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/exchange-rates', [AdminController::class, 'showExchangeRates'])
    ->middleware(['auth', 'verified'])
    ->name('admin.exchange-rates');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [CurrencyConversionController::class, 'showForm'])->name('convert.currency');
Route::post('/', [CurrencyConversionController::class, 'convert'])->name('convert.currency.post');
require __DIR__.'/auth.php';
