<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefasController extends Controller
{
    
    function listar()
    {
        $tarefas = DB::select('SELECT * FROM tarefas');
        return view('tarefas.list', ['tarefas' => $tarefas]);
    }

    function visualizar($id)
    {
        $tarefa = $this->getTarefaById($id);
        return view('tarefas.view', ['tarefa' => $tarefa]);
    }

    function adicionar()
    {
        return view('tarefas.form', ['editMode' => false]);
    }

    function adicionarAcao(Request $request)
    {
        return $this->saveTarefa($request);
    }

    function editar($id)
    {
        $tarefa = $this->getTarefaById($id);
        return empty($tarefa) ? redirect()->route('tarefas') : view('tarefas.form', ['tarefa' => $tarefa, 'editMode' => true]);
    }

    function editarAcao(Request $request, $id)
    {
        return $this->saveTarefa($request, true, $id);
    }

    function deletar($id)
    {
        DB::delete('DELETE tarefas WHERE id = ?', [$id]);
        return redirect()->route('tarefas');
    }

    function marcarTarefa($id)
    {
        DB::update('UPDATE tarefas SET resolvido = 1 - resolvido WHERE id = :id', [
            ':id' => $id
        ]);
        return redirect()->route('tarefas');
    }

    private function getTarefaById($id)
    {
        return DB::selectOne('SELECT * FROM tarefas WHERE id = :id', [':id' => $id]);
    }

    private function saveTarefa(Request $request, bool $editMode = false, $id = 0)
    {
        $request->validate([
            'titulo' => ['required', 'string']
        ]);

        $titulo = $request->input('titulo');
        $situacao = $request->input('finalizada') ? 1: 0;
        
        if ($editMode) {
            DB::update('UPDATE tarefas SET titulo = :titulo, resolvido = :resolvido WHERE id = :id', [
                ':id' => $id,
                ':titulo' => $titulo,
                ':resolvido' => $situacao
            ]);
        } else {
            DB::insert('INSERT INTO tarefas SET titulo = ?, resolvido = ?', [
                $titulo,
                $situacao
            ]);
        }

        return redirect()->route('tarefas');
    }

}
