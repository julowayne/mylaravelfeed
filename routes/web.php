<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');


Route::post('/', '\App\Http\Controllers\HomeController@createPost');

Route::post('/user/changeName', '\App\Http\Controllers\HomeController@updateUserName')->name('changeUsername');
Route::post('/user/changeEmail', '\App\Http\Controllers\HomeController@updateUserEmail')->name('changeUserEmail');;
Route::post('/user/changePassword', '\App\Http\Controllers\HomeController@updateUserPassword')->name('changeUserPassword');;
Route::post('/user/changeAvatar', '\App\Http\Controllers\HomeController@updateUserAvatar')->name('changeUserAvatar');;