<?php

namespace stock\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;

class ProductController
{
    public function list()
    {
        $products = DB::select("SELECT * FROM produtos");

        $data = array(
        	"products" => $products
        );
        return $this->getView("products", $data);
    }

    public function open()
    {
    	$id = Request::input("id", 0);
    	$product = DB::select("SELECT * FROM produtos WHERE id = :id", array(":id" => $id));

    	if (empty($id)) return "Produto não existe";

    	$data = array(
    		"p" => $product[0]
    	);
    	return $this->getView("product", $data);
    }

    private function getView($viewName, $viewData = array())
    {
    	return (view()->exists($viewName)) ? view($viewName, $viewData) : "Page Not Found";
    }
}