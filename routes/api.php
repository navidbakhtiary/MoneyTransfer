<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\TransferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('bank-accounts')->group(function () {
    Route::post('/save', [BankAccountController::class, 'store']);
});

Route::prefix('transfers')->group(function () {
    Route::post('/', [TransferController::class, 'index']);
    Route::post('/save', [TransferController::class, 'store']);
});
