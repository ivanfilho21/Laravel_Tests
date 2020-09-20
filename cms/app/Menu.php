<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = [
        'name', 'page_id', 'page_url', 'created_by'
    ];

    public function getUrlAttribute() {
        $id = $this->page_id;
        $page = $id ? Page::find($id) : null;
        return $page ? "/{$page->slug}" : $this->page_url;
    }

    public function getSubmenusAttribute() {
        $submenus = Menu::where('parent_id', $this->id)->get();
        return count($submenus) == 0 ? null : $submenus;
    }

}
