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
Route::post('/users', 'AuthController@store')->name('users.store');
Route::post('/login', 'AuthController@login')->name('users.login');
//les routes protegées
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/clients', 'ClientController@index')->name('clients.all');
    Route::delete('/clients/{clients}', 'ClientController@destroy')->name('clients.destroy');
    Route::post('/clients', 'ClientController@store')->middleware('auth:sanctum');
    Route::get('/logout', 'AuthController@logout')->name('users.logout');
    Route::put('/clients/{clients}', 'ClientController@update')->name('clients.update');
    Route::get('/clients/{clients}', 'ClientController@show')->name('clients.show');

});
