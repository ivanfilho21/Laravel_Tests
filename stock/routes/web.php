<?php

// Route::get("/", function() { return "Hello World"; });
Auth::routes();
Route::get("/", "HomeController@index")->name("home");
Route::get('/home', 'HomeController@index')->name('home');

Route::get("/produtos", "ProductController@list");
Route::get("/produtos/json", "ProductController@listJson");
Route::get("/produto/{id}", "ProductController@open")->where("id", "[0-9]+");
Route::post("/produtos/save", "ProductController@save");
Route::get("/produto", "ProductController@createEdit");
Route::get("/produto/editar/{id?}", "ProductController@createEdit")->where("id", "[0-9]+");
Route::get("/produto/apagar/{id}", "ProductController@delete")->where("id", "[0-9]+");

Route::get("/mylogin", "MyAuthController@login");