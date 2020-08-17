<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Post;

class PostController extends Controller
{

    public function index()
    {
        return view('posts.list')->with(['posts' => Post::all()]);
    }

    public function create()
    {
        return view('posts.form')->with(['editMode' => false, 'formAction' => route('posts.store')]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required', 'string'],
            'conteudo' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        return $this->savePost($request);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return empty($post) ? redirect()->route('posts.index') : view('posts.view')->with(['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return empty($post) ? redirect()->route('posts.index') : view('posts.form')->with(['post' => $post, 'editMode' => true, 'formAction' => route('posts.update', ['post' => $id])]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required', 'string'],
            'conteudo' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        return $this->savePost($request, $id);
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('posts.index');
    }

    private function savePost(Request $request, $id = 0)
    {
        $post = empty($id) ? new Post : Post::find($id);
        $post->titulo = $request->input('titulo');
        $post->body = $request->input('conteudo');
        $post->save();

        return redirect()->route('posts.index');
    }

}
