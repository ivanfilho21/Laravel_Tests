<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public function getPageAttribute() {
        return Page::select('title', 'slug')->where('id', $this->page_id)->get()[0];    
    }

    public function getSubmenusAttribute() {
        $submenus = Menu::where('parent_id', $this->id)->get();
        return count($submenus) == 0 ? null : $submenus;
    }

}
