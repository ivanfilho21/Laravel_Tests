<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

// Auth::routes();
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@authenticate');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register', 'Auth\RegisterController@register');


Route::prefix('/config')->group(function () {
    Route::get('/', 'ConfigController@index')->name('config.index');
    Route::put('/home_message', 'ConfigController@changeHomeMessage')->name('config.message');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::redirect('/', 'home');
