<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Settings;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = [];
        $sett = Settings::get();

        foreach ($sett as $s) {
            $settings[$s['name']] = $s['value'];
        }

        return view('admin_panel.settings.index', ['settings' => $settings]);
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
            Settings::where('name', $key)->update([
                'value' => $value
            ]);
        }

        return redirect()->back()->with('success', __('util.site_settings_update_success'));
    }

}
