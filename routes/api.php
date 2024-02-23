<?php

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

// Deposit Routes
Route::middleware('auth:sanctum')->prefix('/deposit')->group(function () {
  Route::post('/paypal-confirm', [App\Http\Controllers\Api\Deposit\PaypalController::class, 'index']);
});

// Admin Routes
Route::middleware(['auth:sanctum', 'admin'])->prefix('/admin')->group(function () {
  // User Routes
  Route::prefix('/users')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Admin\UserController::class, 'index']);
  });

  // Transaction Routes
  Route::prefix('/transactions')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Admin\TransactionController::class, 'index']);
  });
  // History Routes
  Route::prefix('/histories')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Admin\HistoryController::class, 'index']);
  });
  // Tools Routes
  Route::prefix('/tools')->group(function () {
    Route::post('/upload', [App\Http\Controllers\Api\Tools\UploadController::class, 'index']);
  });
});

// Games Routes
Route::middleware('auth:sanctum')->prefix('/games')->group(function () {
  Route::post('/spin-quest/turn', [App\Http\Controllers\Api\Game\SpinQuestController::class, 'turn']);

  // withdraws
  Route::get('/withdraws', [App\Http\Controllers\Api\Game\WithdrawController::class, 'index']);
  Route::post('/withdraws', [App\Http\Controllers\Api\Game\WithdrawController::class, 'store']);
});

// Accounts Routes
Route::middleware(['auth:sanctum'])->prefix('/accounts')->group(function () {
  // Profiles Routes
  Route::get('/histories', [App\Http\Controllers\Api\Account\HistoryController::class, 'index']);
  Route::get('/transactions', [App\Http\Controllers\Api\Account\TransactionController::class, 'index']);
  // Invoices Routes
  Route::get('/invoices', [App\Http\Controllers\Api\Account\InvoiceController::class, 'index']);
  Route::get('/invoices/{id}', [App\Http\Controllers\Api\Account\InvoiceController::class, 'show']);
  Route::post('/invoices', [App\Http\Controllers\Api\Account\InvoiceController::class, 'store']);
  // Deposits Routes
  Route::get('/card-list', [App\Http\Controllers\Api\Account\DepositController::class, 'cardList']);
  Route::post('/send-card', [App\Http\Controllers\Api\Account\DepositController::class, 'sendCard']);

});

// Static Routes
Route::prefix('/static')->group(function () {
  Route::get('/skins/{id}', [App\Http\Controllers\Api\Store\AccountController::class, 'skins']);
  Route::get('/champions/{id}', [App\Http\Controllers\Api\Store\AccountController::class, 'champions']);
});

// Store Routes
Route::prefix('/stores')->group(function () {
  Route::prefix('/accounts')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Store\AccountController::class, 'index']);
    Route::get('/{code}', [App\Http\Controllers\Api\Store\AccountController::class, 'show']);
    Route::post('/{code}/buy', [App\Http\Controllers\Api\Store\AccountController::class, 'buy'])->middleware('auth:sanctum');
  });
  Route::prefix('/accounts-v2')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Store\AccountV2Controller::class, 'index']);
    Route::get('/{code}', [App\Http\Controllers\Api\Store\AccountV2Controller::class, 'show']);
    Route::post('/{code}/buy', [App\Http\Controllers\Api\Store\AccountV2Controller::class, 'buy'])->middleware('auth:sanctum');
  });
  Route::prefix('/items')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Store\ItemController::class, 'index']);
    Route::get('/{code}', [App\Http\Controllers\Api\Store\ItemController::class, 'show']);
    Route::post('/{slug}/buy', [App\Http\Controllers\Api\Store\ItemController::class, 'buy'])->middleware('auth:sanctum');
  });
  Route::prefix('/boosting-game')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\Store\BoostingGameController::class, 'index']);
    Route::get('/{slug}', [App\Http\Controllers\Api\Store\BoostingGameController::class, 'show']);
    Route::post('/{slug}/buy', [App\Http\Controllers\Api\Store\BoostingGameController::class, 'buy'])->middleware('auth:sanctum');
  });
});
