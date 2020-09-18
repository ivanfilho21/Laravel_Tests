<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');

Route::prefix('panel')->group(function () {
    Route::get('/', 'AdminPanel\DashboardController@index')->name('panel.index');
    Route::put('/', 'AdminPanel\DashboardController@storePeriod')->name('panel.storePeriod');

    Route::get('/login', 'AdminPanel\Auth\LoginController@index')->name('panel.login');
    Route::post('/login', 'AdminPanel\Auth\LoginController@authenticate');
    Route::get('/register', 'AdminPanel\Auth\RegisterController@index')->name('panel.register');
    Route::post('/register', 'AdminPanel\Auth\RegisterController@register');
    Route::post('/logout', 'AdminPanel\Auth\LoginController@logout')->name('panel.logout');

    Route::resource('users', 'AdminPanel\UserController');

    Route::get('/profile', 'AdminPanel\ProfileController@index')->name('panel.profile');
    Route::put('/profile', 'AdminPanel\ProfileController@update')->name('panel.profile.save');

    Route::get('/layout', 'AdminPanel\SiteLayoutController@index')->name('panel.layout');
    Route::put('/layout', 'AdminPanel\SiteLayoutController@save')->name('panel.layout.save');

    Route::resource('pages','AdminPanel\PageController');
});

// Auth::routes();

Route::get('/home', 'Site\HomeController@index')->name('site.index');
