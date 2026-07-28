<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class Galeria extends Model{

    protected $table = 'tbl_galeria';
    protected $primaryKey = 'id_galeria';
    public $timestamps = true;

    const CREATED_AT = 'data_criacao_galeria';
    const UPDATED_AT = 'data_atualizacao_galeria';

    protected $fillable = [
        'nome_galeria',
        'imagem_galeria',
        'status_galeria',
    ];

}
