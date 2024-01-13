<?php

use App\Http\Controllers\FundController;
use App\Http\Controllers\FundDuplicatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('funds', [FundController::class, 'index'])->name('funds.index');
Route::put('funds/{fund}', [FundController::class, 'update'])->name('funds.update');
Route::get('funds/{fund}/duplicates', [FundDuplicatesController::class, 'index'])->name('funds.duplicates');
