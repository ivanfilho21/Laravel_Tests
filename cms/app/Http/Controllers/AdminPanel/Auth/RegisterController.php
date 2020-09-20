<?php

namespace App\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::PANEL_HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('admin_panel.auth.register');
    }

    public function register(Request $request)
    {
        $dados = $request->only([
            'name', 'email', 'password', 'password_confirmation'
        ]);

        $validator = $this->validator($dados);
        if ($validator->fails()) {
            return redirect()->route('panel.register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = $this->create($dados);
        Auth::login($user);

        return redirect()->route('panel.index');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => User::TYPE_ADMIN,
            'created_by' => 0,
        ]);
    }
}
