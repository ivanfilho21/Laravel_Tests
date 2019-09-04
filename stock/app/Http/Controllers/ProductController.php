<?php

namespace stock\Http\Controllers;

use Illuminate\Support\Facades\DB;
use stock\Product;
use Request;
use stock\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("my-middleware", array(
            "only" => array("save, delete")
        ));
    }

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

    public function createEdit()
    {
        $id = Request::route("id", 0);
        $product = Product::find($id);

        $data = array(
            "p" => $product
        );
        return $this->getView("product-form", $data);
    }

    public function save(ProductRequest $request)
    {
        // $inputs = Request::all();
        $prod = Product::find($request->input("id"));
        $prod = ! empty($prod) ? $prod : new Product();

        $prod->nome = $request->input("name");
        $prod->descricao = $request->input("description");
        $prod->valor = $request->input("price");
        $prod->quantidade = $request->input("qty");

        $prod->save();

        // DB::insert("INSERT INTO produtos(nome, quantidade, valor, descricao) values(?, ?, ?, ?)", array($name, $qty, $price, $desc));

        // return redirect("/produtos")->withInput(Request::only("name"));
        return redirect()
                    ->action("ProductController@list")
                    ->withInput(Request::only("name", "id"));
    }

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