<?php

namespace stock\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProductController
{
    public function list()
    {
        $products = DB::select("select * from produtos");

        // return view("products")->withProducts($products);
        return (view()->exists("products")) ? view("products")->with("products", $products) : "Page Not Found";
    }
}