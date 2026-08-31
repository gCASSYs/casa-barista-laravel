<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinhaTempo;

class LinhaTempoController extends Controller
{   
    //Lista todas as linhas tempo cadastrados
    public function index()
    {
        $listaLinhaTempo = LinhaTempo::orderBy('id_linha_tempo')->get();

        
        return view('admin.linhatempo.index', compact('listaLinhaTempo'));
    }
}