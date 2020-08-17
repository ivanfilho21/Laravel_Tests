<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    function index(Request $request)
    {
        # Pegar dados na url (GET, etc.)
        $query = $request->query();

        # Pegar dados no body (POST, PUT, etc.)
        $inputs = $request->input();

        # Pegar todos os dados
        $all = $request->all();
        echo '<pre>'.var_export($all,1).'</pre>';

        # Retorna o dado ou então um valor padrão.
        $msg = $request->query('mensagem', 'Valor padrão');
        echo 'Sua mensagem é: '.$msg;

        return view('admin.admin', ['msg' => $msg]);
    }

    function receberDados(Request $req)
    {
        # dados = $req->only(['mensagem']);
        # dados = $req->except(['submit']);
        $msg = $req->input('mensagem', '');
        echo 'Mensagem: '.$msg;
    }

}
