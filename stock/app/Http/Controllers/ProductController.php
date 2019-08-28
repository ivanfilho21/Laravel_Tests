<?php

namespace stock\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProductController
{
    public function list()
    {
        $products = DB::select("select * from produtos");
        $ul = "<ul>";
        foreach ($products as $p) {
            $ul .= "<li>" .$p->nome ." " .$p->descricao ."</li>";
        }
        $ul .= "</ul>";
        return "<h1>Products</h1>" .$ul;
    }
}