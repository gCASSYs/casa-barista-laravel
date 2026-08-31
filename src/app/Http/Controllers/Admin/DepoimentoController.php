<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depoimento;

class DepoimentoController extends Controller
{   
    //Lista todos os depoimentos cadastrados
    public function index()
    {
        $listaDepoimento = Depoimento::orderBy('id_depoimento')->get();

        
        return view('admin.depoimento.index', compact('listaDepoimento'));
    }
}