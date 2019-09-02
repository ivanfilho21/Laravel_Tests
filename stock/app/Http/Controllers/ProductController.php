<?php

namespace stock\Http\Controllers;

use Illuminate\Support\Facades\DB;
use stock\Product;
use Request;

class ProductController
{
    public function list()
    {
        // $products = DB::select("SELECT * FROM produtos");
        $products = Product::all();

        $data = array(
        	"products" => $products
        );
        return $this->getView("products", $data);
    }

    public function listJson()
    {
        $products = Product::all();

        // Returns a JSON by default
        // return $products;
        return response()->json($products);
    }

    public function open()
    {
        // $id = Request::input("id", 0);
    	$id = Request::route("id", 0);
    	$product = Product::find($id);

    	if (empty($product)) return "Produto não existe";

    	$data = array(
    		"p" => $product
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
        $prod = new Product();
        $prod->nome = Request::input("name");
        $prod->descricao = Request::input("description");
        $prod->valor = Request::input("price");
        $prod->quantidade = Request::input("qty");

        $prod->save();

        // DB::insert("INSERT INTO produtos(nome, quantidade, valor, descricao) values(?, ?, ?, ?)", array($name, $qty, $price, $desc));

        // return redirect("/produtos")->withInput(Request::only("name"));
        return redirect()
                    ->action("ProductController@list")
                    ->withInput(Request::only("name"));
    }

    public function edit()
    {}

    public function delete()
    {
        $id = Request::route("id", 0);
        $product = Product::find($id);
        $product->delete();

        return redirect()
                    ->action("ProductController@list");
    }

    private function getView($viewName, $viewData = array())
    {
        $path = "product/";
        return (view()->exists($path.$viewName)) ? view($path.$viewName, $viewData) : "Page Not Found";
    }
}