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

    public function listJson()
    {
        $products = DB::select("SELECT * FROM produtos");

        // Returns a JSON by default
        // return $products;
        return response()->json($products);
    }

    public function open()
    {
        // $id = Request::input("id", 0);
    	$id = Request::route("id", 0);
    	$product = DB::select("SELECT * FROM produtos WHERE id = :id", array(":id" => $id));

    	if (empty($product)) return "Produto não existe";

    	$data = array(
    		"p" => $product[0]
    	);
    	return $this->getView("product", $data);
    }

    public function create()
    {
        return $this->getView("product-form");
    }

    public function add()
    {
        // $inputs = Request::all();
        $name = Request::input("name");
        $desc = Request::input("description");
        $price = Request::input("price");
        $qty = Request::input("qty");

        DB::insert("INSERT INTO produtos(nome, quantidade, valor, descricao) values(?, ?, ?, ?)", array($name, $qty, $price, $desc));

        // return redirect("/produtos")->withInput(Request::only("name"));
        return redirect("/produtos")
                    ->action("ProductController@list")
                    ->withInput(Request::only("name"));
    }

    private function getView($viewName, $viewData = array())
    {
        $path = "product/";
        return (view()->exists($path.$viewName)) ? view($path.$viewName, $viewData) : "Page Not Found";
    }
}