<?php

namespace App\Models;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;

Class Produto extends Model{

    protected $table = 'tbl_produto';
    protected $primaryKey = 'id_produto';
    public $timestamps = true;  

    const CREATED_AT = 'data_criacao_produto';
    const UPDATED_AT = 'data_atualizacao_produto';
 
    protected $fillable = [
        'id_categoria',
        'nome_produto',
        'imagem_produto',
        'descricao_curta_produto',
        'descricao_longa_produto',
        'valor_produto',
        'status_produto',
    ];

    //relacionamento onde 1 produto pertence a 1 categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}    