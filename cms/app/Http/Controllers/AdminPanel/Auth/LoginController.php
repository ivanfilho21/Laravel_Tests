<?php

namespace App\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::PANEL_HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('admin_panel.auth.login');
    }

    public function authenticate(Request $request)
    {
        $dados = $request->only(['email', 'password']);
        $validator = Validator::make($dados, [
            'email' => '',
            'password' => ''
        ]);
        $remember = $request->input('remember', false);

        if (Auth::attempt($dados, $remember)) {
            return redirect($this->redirectTo);
        }

        $validator->errors()->add('password', __('auth.failed'));
        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect($this->redirectTo);
    }

}
