<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{

    private $response = ['error' => '', 'result' => []];

    public function index()
    {
        $notes = Note::all();
        foreach ($notes as $n) {
            $note = [
                'id' => $n->id,
                'id_owner' => $n->id_owner,
                'title' => $n->title
            ];
            $this->response['result'][] = $note;
        }
        return $this->response;
    }

    public function create(Request $request)
    {
        if ($request->filled('title')) {
            $note = new Note();
            $note->title = $request->title;
            $note->body = $request->input('body', '');
            $note->id_owner = $request->input('id_user', 0);
            $note->save();
            $this->response['result'] = $note->id;
        } else {
            $this->response['error'] = 'A nota precisa de um título.';
        }

        return $this->response;
    }

    public function read(Request $request)
    {
        $note = Note::find($request->id);

        if ($note) {
            $this->response['result'] = $note;
        } else {
            $this->response['error'] = 'ID não encontrado';
        }

        return $this->response;
    }

    public function update(Request $request)
    {
        $note = Note::find($request->id);

        if ($note) {
            $note->title = $request->title ? $request->title : $note->title;
            $note->body = $request->body ? $request->body : $note->body;
            $note->id_owner = $request->id_user ? $request->id_user : $note->id_owner;
            $note->save();
            $this->response['result'] = $note->id;
        } else {
            $this->response['error'] = 'ID não encontrado.';
        }

        return $this->response;
    }

    public function delete(Request $request)
    {
        $note = Note::find($request->id);
        if ($note) {
            $note->delete();
        } else {
            $this->response['error'] = 'ID não encontrado.';
        }
        return $this->response;
    }

}
