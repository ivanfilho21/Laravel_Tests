<?php

Route::get("/", function() { return "Hello World"; });

Route::get("/produtos", "ProductController@list");
Route::get("/produtos/json", "ProductController@listJson");
Route::get("/produto", "ProductController@create");
Route::get("/produto/{id}", "ProductController@open")->where("id", "[0-9]+");
Route::post("/produtos/add", "ProductController@add");
/*Route::get("/produto/editar/{id}", "ProductController@edit");
Route::get("/produto/apagar/{id}", "ProductController@delete");