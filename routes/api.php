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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/users', 'AuthController@store')->name('users.store');
Route::post('/login', 'AuthController@login')->name('users.login');
Route::get('/clients', 'ClientController@index')->name('clients.all');
//Route::get('/expenses/{expense}', 'ExpenseController@show')->name('expenses.show');
//Route::put('/expenses/{expense}', 'ExpenseController@update')->name('expenses.update');
//Route::delete('/expenses/{expense}', 'ExpenseController@destroy')->name('expenses.destroy');
Route::get('/clients/{clients}', 'ClientController@show')->name('clients.show');
Route::delete('/clients/{clients}', 'ClientController@destroy')->name('clients.destroy');
//les routes protegées
Route::middleware('auth:sanctum')->group(function(){
    //Route::get('/expenses', 'ExpenseController@index')->name('expenses.all');
   // Route::post('/expenses', 'ExpenseController@store')->name('expenses.strore');
   // Route::middleware('auth:sanctum')->post('/expenses', 'ExpenseController@store');
  //  Route::post('/expenses', 'ExpenseController@store')->middleware('auth:sanctum');
    Route::post('/clients', 'ClientController@store')->middleware('auth:sanctum');
    Route::get('/logout', 'AuthController@logout')->name('users.logout');
    Route::put('/clients/{clients}', 'ClientController@update')->name('clients.update');

});


