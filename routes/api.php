<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GuestController;

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

Route::group(['prefix' => '/guests', 'namespace' => "App\Http\Controllers\Api"], function () {
    Route::get('/', 'GuestController@index');
    Route::post('/', 'GuestController@create');
    Route::delete('/{id}', 'GuestController@destroy');
    Route::patch('/{id}', 'GuestController@update');
    Route::get('/{id}', 'GuestController@show');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


