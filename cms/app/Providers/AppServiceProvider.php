<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Page;
use App\Menu;
use App\Layout;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Compartilha os menus do front com todas as views
        $menusAll = Menu::all();
        $menus = [];

        foreach ($menusAll as $menu) {
            $parentMenu = Menu::find($menu->parent_id);
            if ($parentMenu) continue;

            $menus[] = $menu;
        }

        View::share('menus', $menus);

        // Site Layout

        $siteLayout = [];
        $layouts = Layout::all();

        foreach ($layouts as $layout) {
            $siteLayout[$layout['name']] = $layout['value'];
        }
        View::share('siteLayout', $siteLayout);
    }
}
