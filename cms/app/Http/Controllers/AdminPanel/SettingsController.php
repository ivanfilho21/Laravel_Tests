<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
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

}
