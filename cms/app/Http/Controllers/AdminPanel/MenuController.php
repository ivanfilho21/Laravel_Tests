<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Page;
use App\Menu;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // TODO: pegar apenas os que não sejam submenus
        $menus = Menu::orderBy('id', 'desc')->paginate(10);
        return view('admin_panel.menus.index', ['menus' => $menus]);
    }

    public function create()
    {
        return view('admin_panel.menus.form', [
            'menu' => Menu::find(1),
            'pages' => Page::all(),
            'editMode' => false,
        ]);
    }

    public function store(Request $request)
    {
        $data = [];
        $rules = [];

        $data['name'] = $request->input('name');
        $rules['name'] = ['required', 'string', 'max:15'];

        $pageType = $request->input('page_type', 0);

        switch ($pageType) {
            case 0:
                $data['page_site'] = $request->input('page_site');
                $rules['page_site'] = ['required', 'numeric'];
                break;
            case 1:
                $data['page_url'] = $request->input('page_url');
                $rules['page_url'] = ['required', 'url'];
                break;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Pega o index da página selecionada e pega a página do banco
        $index = $data['page_site'] ?? null;
        $pages = $index !== null ? Page::all() : null;
        $page = $pages ? $pages[$index] : null;

        Menu::create([
            'name' => $data['name'],
            'page_id' => $page->id ?? null,
            'page_url' => $data['page_url'] ?? null,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('menus.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
