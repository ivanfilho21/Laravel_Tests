<?php

namespace stock;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = "produtos";
    /*protected $fillable = array("nome", "descricao", "valor", "quantidade");
    protected $guarded = array("id");*/
}
