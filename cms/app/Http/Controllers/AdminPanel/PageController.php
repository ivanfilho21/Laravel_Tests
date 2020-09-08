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
        return view('admin_panel.pages.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'body']);
        $data['slug'] = Str::slug($data['title'], '-');

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

    public function destroy($id)
    {
        $page = Page::find($id);

        if ($page) {
            $page->delete();
        }

        return redirect()->route('pages.index');
    }
}
