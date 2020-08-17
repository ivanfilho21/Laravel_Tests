<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTime;

class Pet extends Model
{
    # Define o nome da tabela no banco caso não seja o nome do model no plural
    // protected $table = 'pets';

    # nome da chave primaria
    // protected $primaryKey = 'id';

    # auto increment ou nao
    // protected $incrementing = true;

    # tipo da chave primaria
    // protected $keyType = 'int';

    # timestamps: caso não haja
    // public $timestamps = false;

    # timestamps: nomes
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    # formato de datas diferente do padrão
    // protected $dateFormat = 'U';

    # Quais campos poderão ser alterados
    protected $fillable = [
        'nome', 'data_nascimento'
    ];

    function getIdadeAttribute()
    {
        $date = new DateTime($this->data_nascimento);
        $interval = $date->diff(new DateTime(date('Y-m-d')));
        return $interval->format('%y');
    }

}
