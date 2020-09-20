<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = [
        'name', 'page_id', 'page_url', 'created_by'
    ];

    public function getPageAttribute() {
        $id = $this->page_id;
        return $id ? Page::select('title', 'slug')->where('id', $id)->get()[0] : null;
    }

    public function getPageSlugAttribute() {
        return $this->page ? "/$this->page->slug" : null;
    }

    public function getSubmenusAttribute() {
        $submenus = Menu::where('parent_id', $this->id)->get();
        return count($submenus) == 0 ? null : $submenus;
    }

}
