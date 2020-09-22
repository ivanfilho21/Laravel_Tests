<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin_panel.pages.index', ['pages' => Page::paginate(10)]);
    }

    public function create()
    {
        return view('admin_panel.pages.form', [
            'page' => new Page(),
            'editMode' => false,
            'pageTitle' => __('titles.pages_create'),
            'formAction' => route('pages.store'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'body']);
        $data['slug'] = $this->generateSlug($data['title']);

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'unique:pages'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Page::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'slug' => $data['slug'],
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pages.index');
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
        $page = Page::find($id);
        if (! $page) return redirect()->back();
    
        return view('admin_panel.pages.form', [
            'page' => $page,
            'editMode' => true,
            'pageTitle' => __('titles.pages_edit'),
            'formAction' => route('pages.update', ['page' => $page->id]),
        ]);
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        if (! $page) return redirect()->back();

        $data = $request->only('title', 'body');

        # Inicializa com o valor atual de slug
        $data['slug'] = $page->slug;

        # As regras de validação
        $validationRules = [];
        $validationRules['title'] = ['required', 'string', 'max:100'];

        # 1. verificamos se o título foi alterado. Se sim geramos um novo slug e adicionamos para validação
        if (! $this->equals($data['title'], $page->title)) {
            $data['slug'] = $this->generateSlug($data['title']);
            $validationRules['slug'] = ['required', 'string', 'unique:pages'];
        }

        # 2. Gera o objeto de Validator com base nas chaves de validationRules
        $dataToValidate = [];
        foreach ($validationRules as $k => $v) {
            if (! isset($data[$k])) continue;
            $dataToValidate[$k] = $data[$k];
        }
        $validator = Validator($dataToValidate, $validationRules);

        # 3. Verifica se a validação falhou e então redireciona de volta
        if ($validator->fails()) {
            $validator->errors()->add('title', __('validation.title_unique'));
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        # 4. Faz as alterações
        $page->title = $data['title'];
        $page->body = $data['body'];
        $page->slug = $data['slug'];
        $page->save();

        # Se tudo correu bem, redirecionamos de volta com uma mensagem de sucesso
        return redirect()->route('pages.index')->with('success', __('messages.pages_update_success'));
    }

    public function destroy($id)
    {
        $page = Page::find($id);

        if ($page) {
            $page->delete();
        }

        return redirect()->route('pages.index');
    }

    private function equals($str1, $str2)
    {
        $str1 = $this->removeAccents($str1);
        $str2 = $this->removeAccents($str2);
        return strcasecmp($str1, $str2) == 0;
    }

    private function removeAccents($str) {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    }

    private function generateSlug($str)
    {
        return Str::slug($str, '-');
    }

}
