<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

use App\Config;

class ConfigController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Gate::denies('access-config')) {
            return redirect()->route('home');
        }
        $config = Config::find(1);
        return view('config', ['config' => $config]);
    }

    public function changeHomeMessage(Request $request)
    {
        $dados = $request->only(['message']);
        $validator = Validator::make($dados, [
            'message' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()->route('config.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        # salvar no banco
        $config = Config::find(1);
        $config = empty($config) ? new Config() : $config;
        $config->message = $dados['message'];
        $config->save();

        return redirect()->route('home');
    }
}
