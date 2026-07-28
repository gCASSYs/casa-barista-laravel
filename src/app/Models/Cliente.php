<?php

namespace App\Models;

use App\Models\Depoimento;
use Illuminate\Database\Eloquent\Model;

Class Cliente extends Model{

    protected $table = 'tbl_cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps = true;


    //O laravel que vai controlar os campos de data de criação e atualização, mas como o nome dos campos não são os padrões do laravel, então precisamos informar quais são os nomes dos campos que vão controlar a data de criação e atualização
    const CREATE_AT = 'data_criacao_cliente';
    const UPDATE_AT = 'data_atualizacao_cliente';

    protected $fillable = [
        'nome_cliente',
        'email_cliente',
        'senha_cliente',
        'foto_cliente',
        'status_cliente',
    ];

    //relacionamento onde 1 cliente pertence a muitos depoimentos
    public function ClienteDepoimento(){
        return $this->hasMany(Depoimento::class, 'id_cliente', 'id_cliente');
    }

}