<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\TransactionsController;
use App\Http\Controllers\Api\v1\PersonsController;
use App\Http\Controllers\Api\v1\CategoriesController;
use App\Http\Controllers\Api\v1\TypeProfitController;
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

Route::resource('transactions', TransactionsController::class);
Route::resource('persons', PersonsController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('type_profit', TypeProfitController::class);
