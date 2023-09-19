<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Models\Alias;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return to_route('dashboard');
})->middleware('auth');

Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('funds/create', [FundController::class, 'create'])
        ->name('fund.create');

    Route::get('funds/{fund:uuid}', [FundController::class, 'show'])
        ->name('fund.show');

    Route::get('managers', [ManagerController::class, 'index'])
        ->name('manager.index');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
