<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return view('home', ['config' => Config::find(1), 'user' => $user]);
    }
}
