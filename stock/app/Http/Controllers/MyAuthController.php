<?php

namespace stock\Http\Controllers;

use Request;
use Auth;

class MyAuthController extends Controller
{
    public function login()
    {
    	$credentials = Request::only("email", "password");
    	
    	//                    [email, pass], keep loged  
    	return (Auth::attempt($credentials, true)) ? "Usuário " .Auth::user()->name ." logado" : "Login falhou";
    }
}
