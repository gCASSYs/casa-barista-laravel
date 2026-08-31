<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


Class Venda extends Model{

    protected $table = 'tbl_venda';
    protected $primaryKey = 'id_venda';

    const CREATED_AT = 'data_criacao_venda';
    const UPDATED_AT = 'data_atualizacao_venda';

    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'data_hora_venda',
        'observacao_venda',
        'valor_total_venda',
        'forma_pagamento_venda',
        'status_venda',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

}
