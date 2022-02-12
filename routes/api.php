<?php

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

use App\Http\Controllers\ClosedTicketsController;
use App\Http\Controllers\OpenTicketsController;
use App\Http\Controllers\Users\TicketsController;
use Illuminate\Support\Facades\Route;

Route::get('/tickets/open', [OpenTicketsController::class, 'index']);
Route::get('/tickets/closed', [ClosedTicketsController::class, 'index']);

Route::prefix('users')
    ->group(function(){
        Route::get('/{email}/tickets', [TicketsController::class, 'index']);
    });

