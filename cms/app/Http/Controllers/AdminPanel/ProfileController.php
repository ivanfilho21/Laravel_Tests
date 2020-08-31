<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin_panel.profile.index', ['user' => User::find(Auth::id())]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        if (! $user) return redirect()->route('panel.profile');

        $data = $request->only(['name', 'password', 'password_confirmation']);

        # 1. Verificar se nome está digitado corretamente
        $validator = Validator([
            'name' => $data['name'] ?? '',
        ], [
            'name' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        # 2. Alterar nome
        $user->name = $data['name'];

        # 3. Verificar se usuário digitou alguma senha
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
        return redirect()->route('panel.profile')->with('success', __('util.users_update_success'));
    }

}
