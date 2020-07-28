<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// use App\Balance;

// Balance::create([
//     'account_nr'=>'1234567890',
//     'balance'=>'27654967'
// ]);

// Balance::create([
//     'account_nr'=>'0987654321',
//     'balance'=>'2653965'
// ]);


Route::post('/transfer','TransferController@store')->name('transfer');