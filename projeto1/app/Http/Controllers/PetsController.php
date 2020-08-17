<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Pet;

class PetsController extends Controller
{
    
    function listar()
    {
        return view('pets.list', ['pets' => Pet::all()]);
    }

    function visualizar($id)
    {
        $pet = Pet::find($id);
        return empty($pet) ? redirect()->route('pets') : view('pets.view', ['pet' => $pet]);
    }

    function criar()
    {
        return view('pets.form', ['editMode' => false]);
    }

    function atualizar($id)
    {
        $pet = Pet::find($id);
        return empty($pet) ? redirect()->route('pets') : view('pets.form', ['editMode' => true, 'pet' => $pet]);
    }

    function salvar(Request $request, $id = 0)
    {
        # Valida, senão retorna para o formulário
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'max:10'],
            'data-nascimento' => ['required', 'date']
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $pet = empty($id) ? new Pet() : Pet::find($id);

        # update
        $pet->nome = $request->input('nome');
        $pet->data_nascimento = $request->input('data-nascimento', date('Y-m-d'));
        $pet->save();

        return redirect()->route('pets');
    }

    function destruir($id)
    {
        Pet::find($id)->delete();
        return redirect()->route('pets');
    }

}
