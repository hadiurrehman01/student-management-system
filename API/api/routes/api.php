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

Route::post('/login', 'UserController@Login');
Route::post('/register', 'UserController@Register');
Route::post('/users/list', 'UserController@Listing')->middleware('auth_user');
Route::post('/product/add', 'ProductsController@add')->middleware('auth_user');
Route::post('/product/update', 'ProductsController@Update')->middleware('auth_user');
Route::post('/product/delete', 'ProductsController@Delete')->middleware('auth_user');
Route::post('/product/list', 'ProductsController@List')->middleware('auth_user');


// Route::post('register',[
//    'middleware' => 'cors',
//    'uses' => 'UserController@Register',
// ]);