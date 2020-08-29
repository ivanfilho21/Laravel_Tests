<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        return view('admin_panel.users.index', ['users' => User::paginate(10)]);
    }

    public function create()
    {
        return view('admin_panel.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        return $user ? view('admin_panel.users.edit', ['user' => $user]) : route()->redirect('users.index');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (! $user) return redirect()->route('users.index');

        $data = $request->only('name', 'email', 'password', 'password_confirmation');

        # 1. Verificar se nome e e-mail estão digitados corretamente
        $validator = Validator([
            'name' => $data['name'],
            'email' => $data['email'],
        ], [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:200'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        # 2. Alterar nome
        $user->name = $data['name'];

        # 3. Verificar se e-mail foi alterado (0 iguais, > 0, < 0)
        if (strcmp($user->email, $data['email']) != 0) {

            # 3.1 Verificar se o e-mail já está cadastrado (retorna array)
            $emailValidator = Validator::make([
                'email' => $data['email']
            ], [
                'email' => ['unique:users']
            ]);

            if ($emailValidator->fails()) {
                return redirect()->back()
                    ->withErrors($emailValidator)->withInput();
            }

            $user->email = $data['email'];
        }

        # 4. Verificar se usuário digitou alguma senha
        if (! empty($data['password'])) {
            
            # 4.1 Verficar se as senhas coincidem
            $passValidator = Validator::make([
                'password' => $data['password'],
                'password_confirmation' => $data['password_confirmation']
            ], [
                'password' => ['string', 'min:6', 'confirmed']
            ]);

            if ($passValidator->fails()) {
                return redirect()->back()
                    ->withErrors($passValidator)->withInput();
            }

            $user->password = Hash::make($data['password']);
        }

        $user->save();
        return redirect()->route('users.index')->with('success', __('util.users_update_success'));
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return redirect()->back();
        }

        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return redirect()->route('users.index');
    }
}
