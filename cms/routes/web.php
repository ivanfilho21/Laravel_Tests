<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');

Route::prefix('panel')->group(function () {
    Route::get('/', 'AdminPanel\HomeController@index')->name('panel.index');
    Route::get('/login', 'AdminPanel\Auth\LoginController@index')->name('panel.login');
    Route::post('/login', 'AdminPanel\Auth\LoginController@authenticate');
    Route::get('/register', 'AdminPanel\Auth\RegisterController@index')->name('panel.register');
    Route::post('/register', 'AdminPanel\Auth\RegisterController@register');
    Route::post('/logout', 'AdminPanel\Auth\LoginController@logout')->name('panel.logout');

    Route::post('/users', 'AdminPanel\UserController@index')->name('panel.users');
});

// Auth::routes();

Route::get('/home', 'Site\HomeController@index')->name('site.home');
