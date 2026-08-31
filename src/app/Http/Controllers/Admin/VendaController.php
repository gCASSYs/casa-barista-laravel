<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venda;

class VendaController extends Controller
{   
    //Lista todas as vendas cadastradas
    public function index()
    {
        $listaVenda = Venda::with('cliente')
            ->orderBy('id_venda')
            ->get();

        
        return view('admin.venda.index', compact('listaVenda'));
    }
}
