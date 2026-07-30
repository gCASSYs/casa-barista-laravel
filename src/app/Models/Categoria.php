<?php

namespace App\Models;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;

Class Categoria extends Model{

    protected $table = 'tbl_categoria';
    protected $primaryKey = 'id_categoria';
    public $timestamps = true;  

    const CREATED_AT = 'data_criacao_categoria';
    const UPDATED_AT = 'data_atualizacao_categoria';


    protected $fillable = [
        'nome_categoria',
        'status_categoria',
    ];

    //relacionamento onde 1 categoria pertence a muitos produtos
    public function produto(){
        return $this->hasMany(Produto::class, 'id_categoria', 'id_categoria');
    }
}    
