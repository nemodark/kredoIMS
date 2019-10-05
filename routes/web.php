<?php
use Illuminate\Support\Facades\Auth;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();

// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
//     Route::get('/{any}', function () {
//         // $user = User::find(Auth::user()->id);
//         return view('admin.index');
//     })->where('any', '.*');
//     // Route::resource('users', 'UserController');
// });

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/', function () {
//         // $user = User::find(Auth::user()->id);
//         return redirect("/".Auth::user()->role."/users");
//     });
//     // Route::resource('users', 'UserController');
// });

// Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'manager']], function () {
//     Route::get('/', function () {
//         return view('welcome');
//     });
// });
// Route::group(['prefix' => 'employee', 'middleware' => ['auth', 'employee']], function () {
//     Route::get('/', function () {
//         return view('home');
//     });
// });


Route::get('/{any?}', function (){
    return view('layouts.app');
})->where('any', '^(?!api\/)[\/\w\.-]*');