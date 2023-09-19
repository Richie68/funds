<?php

use App\Http\Controllers\Api\AliasController;
use App\Http\Controllers\Api\FundController;
use App\Http\Controllers\Api\ManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::patch('funds/{fund:uuid}', [FundController::class, 'update'])
    ->name('api.funds.update');

Route::post('funds', [FundController::class, 'store'])
    ->name('api.funds.store');

Route::patch('alias/{alias}', [AliasController::class, 'update'])
    ->name('api.alias-update');

Route::delete('alias/{alias}/{fund}', [AliasController::class, 'destroy'])
    ->name('api.alias-destroy');

Route::post('alias/fund/{fund}', [AliasController::class, 'store'])
    ->name('api.funds.new-alias');

Route::post('/manager/search', [ManagerController::class, 'search'])
    ->name('api.manager.search');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
