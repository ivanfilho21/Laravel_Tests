<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    # Quais campos poderão ser alterados
    protected $fillable = [
        'titulo', 'body'
    ];
}
