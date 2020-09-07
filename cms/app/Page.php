<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    
    protected $fillable = [
        'title', 'body', 'slug', 'created_by', 'updated_by'
    ];
}
