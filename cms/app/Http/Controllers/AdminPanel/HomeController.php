<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Visitor;
use App\Page;
use App\User;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $limitDate = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('accessed_at', '>=', $limitDate)->groupBy('ip')->get();

        $visits = Visitor::count();
        $online = count($onlineList);
        $pages = Page::count();
        $users = User::count();
        return view('admin_panel.home', [
            'visits' => $visits,
            'online' => $online,
            'pages' => $pages,
            'users' => $users
        ]);
    }

}
