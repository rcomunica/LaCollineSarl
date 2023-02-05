<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardPanel;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ShopController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('shop', [ShopController::class, 'index'])->name('shop');


Route::resource('products', ProductosController::class)
    ->except('show')
    ->middleware(['auth', 'verified']);

Route::resource('userlist', DashboardPanel::class)
    ->except(['show'])
    ->middleware(['auth', 'verified']);




// Auth

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
