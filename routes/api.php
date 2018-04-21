<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::resource('drivers', 'Driver\DriverController', ['only' => ['index', 'show']]);

Route::resource('drivers', 'Driver\DriverController', ['except' => ['create', 'edit']]);

Route::resource('access-logs', 'AccessLog\AccessLogController', ['except' => ['create', 'edit']]);

Route::resource('access-tokens', 'AccessToken\AccessTokenController', ['except' => ['create', 'edit']]);

Route::resource('vehicles', 'Vehicle\VehicleController', ['except' => ['create', 'edit']]);
