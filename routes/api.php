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

// menambahkan route untuk Contact
Route::get('/contact','ContactController@all');
Route::get('/contact/{id}','ContactController@show');
Route::post('/contact','ContactController@store');
Route::put('/contact/{id}','ContactController@update');
Route::delete('/contact/{id}','ContactController@delete');
// menambahkan route untuk Content
Route::get('/content','ContentController@all');
Route::get('/content/{id}','ContentController@show');
Route::post('/content','ContentController@store');
Route::put('/content/{id}','ContentController@update');
Route::delete('/content/{id}','ContentController@delete');
Route::get('/workitems','ContentController@getWorkItems');
Route::get('/workitemsByCategory/{category}','ContentController@getWorkItemsByCategory');
Route::get('/filterList','ContentController@getFilterList');
// menambahkan route untuk Category
Route::get('/category','CategoriesController@all');
Route::get('/category/{id}','CategoriesController@show');
Route::post('/category','CategoriesController@store');
Route::put('/category/{id}','CategoriesController@update');
Route::delete('/category/{id}','CategoriesController@delete');
//USERS
Route::prefix('/user')->group( function() {
    Route::post('/login','LoginController@login');
    Route::post('/register','RegisterController@create');
    Route::middleware('auth:api')->get('/all','UserController@index');
    Route::middleware('auth:api')->get('/current','UserController@currentUser');
});
Route::get('/aboutdesc','AboutDescController@all');
Route::get('/aboutdesc/{id}','AboutDescController@show');
Route::post('/aboutdesc','AboutDescController@store');
Route::put('/aboutdesc/{id}','AboutDescController@update');