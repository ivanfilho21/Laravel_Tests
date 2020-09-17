<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Dashboard;
use App\Visitor;
use App\Page;
use App\User;

class HomeController extends Controller
{

    private $dateFormat = 'Y-m-d H:i:s';
    private $options = [];

    public function __construct()
    {
        $this->middleware('auth');

        $this->options = [
            ['title' => __('titles.today'), 'value' => '1 day'],
            ['title' => __('titles.last_days', ['days' => 7]), 'value' => '7 days'],
            ['title' => __('titles.last_month'), 'value' => '1 month'],
            ['title' => __('titles.all_time'), 'value' => ''],
        ];
    }
    
    // TODO: Criar método para salvar opção do usuário no BD

    public function index()
    {
        $limitDate = date($this->dateFormat, strtotime('-5 minutes'));
        $onlineList = $this->getOnlineUsers($limitDate);

        # Essa data limite é usada para gerar número de Visitas e Páginas Mais Visitadas
        $limitDate = $this->getDateLimit();
        $visitsByPeriod = $this->getVisitors($limitDate);
        $visitorsByPage = $this->getVisitorsByPage($limitDate);

        # Inicializando dados básicos do painel principal
        $visits = count($visitsByPeriod);
        $online = count($onlineList);
        $pages = Page::count();
        $users = User::count();

        # Dados do gráfico de torta
        $pageChartData = [];
        $maxPages = 5;
        $i = 0;

        foreach ($visitorsByPage as $v) {
            if ($i >= $maxPages) break;
            $page = Page::find($v['page_id']);
            if (! $page) continue;

            $pageChartData[$page->title] = intval($v['count']);
            $i++;
        }

        $pageLabels = json_encode(array_keys($pageChartData));
        $pageValues = json_encode(array_values($pageChartData));
        $pageColors = [];

        foreach ($pageChartData as $k => $v) {
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
            'options' => $this->options,
            'dashboardPeriod' => Dashboard::find(1)->value,
            
            'latestPages' => $this->getLatestPages(),
            'latestUsers' => $this->getLatestUsers(),
        ]);
    }

    /**
     * Salva o período de tempo de exibição do Dashboard.
     */
    public function storePeriod(Request $request)
    {
        $index = $request->only('period');
        $index = $index ? intval($index['period']) : null;

        $validator = Validator::make(
            ['period' => $index ],
            ['period' => ['required', 'numeric', 'digits:1']
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $option = Dashboard::find(1);
        $option->value = $index;
        $option->save();

        return redirect()->back();
    }

    /**
     * Retorna as quatro últimas páginas criadas.
     */
    private function getLatestPages()
    {
        $pages = Page::orderBy('id', 'desc')->limit(4)->get();

        for ($i = 0; $i < count($pages); $i++) {
            $id = $pages[$i]['created_by'];
            $user = User::find($id);
            $pages[$i]['user'] = $user->name ?? '';
        }

        return $pages;
    }

    /**
     * Retorna os quatro últimos usuários criados.
     */
    private function getLatestUsers()
    {
        $users = User::orderBy('id', 'desc')->limit(4)->get();

        for ($i = 0; $i < count($users); $i++) {
            $id = $users[$i]['created_by'];
            $creator = User::find($id);
            $users[$i]['creator'] = $creator ? $creator->name : __('util.system');
        }

        return $users;
    }

    /**
     * Período de tempo do qual são exibidos alguns
     * dados no Dashboard.
     */
    private function getDateLimit()
    {
        $option = Dashboard::find(1);
        $index = $option ? $option->value : 0;
        
        return date($this->dateFormat, strtotime('-'.$this->options[$index]['value']));
    }

    /**
     * Visitantes que acessaram alguma página do site
     * em um dado período de tempo.
     */
    private function getVisitors($limitDate)
    {
        return Visitor::select('id')
                            ->where('accessed_at', '>=', $limitDate)
                            ->get();
    }

    /**
     * Estimativa de usuários online calculada com base
     * nas páginas acessadas por visitantes nos últimos
     * 5 minutos.
     */
    private function getOnlineUsers($limitDate)
    {
        return Visitor::select('ip')
                            ->where('accessed_at', '>=', $limitDate)
                            ->groupBy('ip')
                            ->get();
    }

    /**
     * Quandidade de visitas únicas por página
     * em ordem crescente.
     */
    private function getVisitorsByPage($limitDate)
    {
        return Visitor::selectRaw('page_id, count(page_id) as count')
                            ->where('accessed_at', '>=', $limitDate)
                            ->orderBy('count', 'desc')
                            ->groupBy('page_id')
                            ->get();
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
