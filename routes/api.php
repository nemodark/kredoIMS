<?php
// use Illuminate\Support\Facades\Auth;

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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('refresh', 'AuthController@refresh');    

Route::group(['middleware' => 'auth:api', 'admin'], function(){
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');

    //users
    Route::get('/users', 'UserController@index');
    Route::post('/users/add', 'UserController@store');
    Route::get('/users/edit/{id}', 'UserController@edit');
    Route::put('/users/update/{id}', 'UserController@update');
    Route::delete('/users/{id}/delete', 'UserController@delete');

    //categories
    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories/add', 'CategoryController@store');
    Route::put('/categories/update/{id}', 'CategoryController@update');

    //brands
    Route::get('/brands', 'BrandController@index');
    Route::post('/brands/add', 'BrandController@store');
    Route::put('/brands/update/{id}', 'BrandController@update');

    //models
});






// Route::group(['prefix' => 'manager', 'middleware' => ['auth:api', 'manager']], function () {
//     Route::get('/', function () {
//         return view('welcome');
//     });
// });
// Route::group(['prefix' => 'employee', 'middleware' => ['auth:api', 'employee']], function () {
//     Route::get('/', function () {
//         return view('home');
//     });
// });

// Route::get('/', function () {
//     return view('welcome');
// });