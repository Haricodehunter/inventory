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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('stocks', 'StockController');
Route::get('stockslist', 'StockController@stockInListapi');
Route::get('stockscategory', 'StockController@getCategory');
Route::get('stockssubcategory', 'StockController@getSubCategory');
Route::get('building', 'StockController@getBuildings');

Route::get('viewStockIn/{id}', 'StockController@viewStockIn');
