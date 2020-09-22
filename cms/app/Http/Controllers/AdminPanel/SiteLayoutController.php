<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Layout;

class SiteLayoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $layout = [
            'title' => '',
            'subtitle' => '',
        ];
        $list = Layout::get();

        foreach ($list as $v) {
            $layout[$v['name']] = $v['value'];
        }

        return view('admin_panel.layout.index', ['layout' => $layout]);
    }

    public function save(Request $request)
    {
        $data = $request->only([
            'title', 'subtitle', 'bg_color', 'pri_txt_color'
        ]);

        $regHex = '/#[a-zA-Z0-9]{6}/i';
        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'subtitle' => ['string', 'nullable', 'max:100'],
            'bg_color' => ['string', 'regex:'.$regHex],
            'pri_txt_color' => ['string', 'regex:'.$regHex],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($data as $key => $value) {
            Layout::where('name', $key)->update([
                'value' => $value
            ]);
        }

        return redirect()->back()->with('success', __('util.layout_update_success'));
    }

}
