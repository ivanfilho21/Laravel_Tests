<?php

Route::get("/", function() { return "Hello World"; });

Route::get("/produtos", "ProductController@list");
Route::get("/produto/{id}", "ProductController@open")->where("id", "[0-9]+");
/*Route::get("/produto/editar/{id}", "ProductController@edit");
Route::get("/produto/apagar/{id}", "ProductController@delete");*/