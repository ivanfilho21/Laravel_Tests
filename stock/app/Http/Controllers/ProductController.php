<?php

namespace stock\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProductController
{
    public function list()
    {
        $products = DB::select("select * from produtos");
        return view("products")->with("products", $products);
    }
}