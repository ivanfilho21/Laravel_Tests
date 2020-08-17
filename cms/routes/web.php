<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');

Route::prefix('panel')->group(function () {
    Route::get('/', 'AdminPanel\HomeController@index')->name('panel.index');
    Route::get('/login', 'AdminPanel\Auth\LoginController@index')->name('panel.login');
});

// Auth::routes();

Route::get('/home', 'Site\HomeController@index')->name('site.home');
