<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request)
    {
        $tries = $request->session()->get('login_tries', 0);
        return view('auth.login', ['tries' => $tries]);
    }

    public function authenticate(Request $request)
    {
        $tries = intval($request->session()->get('login_tries', 0));
        $dados = $request->only(['email', 'password']);

        if (/* $tries <= 3 &&  */Auth::attempt($dados)) {
            $request->session()->forget('login_tries');
            return redirect($this->redirectTo);
        }

        $tries++;
        $request->session()->put('login_tries', $tries);
        $warning = $tries > 3 ? __('auth.throttle', ['seconds' => '30']) : __('auth.failed');

        return redirect()->route('login')->with('warning', $warning);
    }

    public function logout()
    {
        Auth::logout();
        return redirect($this->redirectTo);
    }

}
