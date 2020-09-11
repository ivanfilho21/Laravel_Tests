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
        # Estimativa de pessoas online, isto é, que acessaram alguma página nos últimos 5 minutos
        $limitDate = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('accessed_at', '>=', $limitDate)->groupBy('ip')->get();

        # Inicializando dados básicos do painel principal
        $visits = Visitor::count(); // Visitas no total
        // $visits = Visitor::select('ip')->groupBy('ip')->get()->count(); // Visitas únicas
        $online = count($onlineList);
        $pages = Page::count();
        $users = User::count();

        # Dados do gráfico de torta
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page_id, count(page_id) as count')->groupBy('page_id')->get();
        foreach ($visitsAll as $v) {
            $page = Page::find($v['page_id']);
            if (! $page) continue;

            $pagePie[$page->title] = intval($v['count']);
        }

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));
        $pageColors = [];

        foreach ($pagePie as $k => $v) {
            $pageColors[] = $this->generateRandomColor();
        }
        $pageColors = json_encode(array_values($pageColors));

        # Retorna os dados para a view
        return view('admin_panel.home', [
            'visits' => $visits,
            'online' => $online,
            'pages' => $pages,
            'users' => $users,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
            'pageColors' => $pageColors,
        ]);
    }

    private function generateRandomColor()
    {
        $letters = '0123456789ABCDEF';
        $color = '#';

        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($letters) -1);
            $color .= $letters[$index];
        }

        return $color;
    }

}
