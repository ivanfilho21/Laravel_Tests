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
            'pages' => Page::all(),
            'editMode' => false,
            'formRoute' => route('menus.store'),
        ]);
    }

    public function store(Request $request)
    {
        return $this->validation($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin_panel.menus.form', [
            'menu' => Menu::find($id),
            'pages' => Page::all(),
            'editMode' => true,
            'formRoute' => route('menus.update', ['menu' => $id]),
        ]);
    }

    public function update(Request $request, $id)
    {
        return $this->validation($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if ($menu) {
            $menu->delete();
        }

        return redirect()->route('menus.index');
    }

    private function validation(Request $request, $id = null) {
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

        return $this->saveUpdate($data, $id);
    }

    private function saveUpdate($data, $id = null)
    {
        // Pega o index da página selecionada e pega a página do banco
        $index = $data['page_site'] ?? null;
        $pages = $index !== null ? Page::all() : null;
        // $page = $pages ? $pages[$index] : null;
        $page = $pages[$index] ?? null;
        $pageId = $page->id ?? null;

        if ($id) {
            $menu = Menu::find($id);

            if (! $menu) {
                return redirect()->route('menus.index');
            }

            $menu->name = $data['name'];
            $menu->page_id = $pageId;
            $menu->page_url = $data['page_url'] ?? null;
            $menu->created_by = Auth::id();
            $menu->save();

        } else {

            Menu::create([
                'name' => $data['name'],
                'page_id' => $pageId,
                'page_url' => $data['page_url'] ?? null,
                'created_by' => Auth::id(),
            ]);
        }

        $msg = $id ? __('messages.menus_update_success') : null;
        $redirect = redirect()->route('menus.index');
        if ($msg) {
            $redirect->with('success', $msg);
        }
        return $redirect;
    }

}
