<?php

Route::get("/", function() { return "Hello World"; });

Route::get("/products", "ProductController@list");