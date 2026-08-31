<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;

class GaleriaController extends Controller
{   
    //Lista todos os galérias cadastrados
    public function index()
    {
        $listaGaleria = Galeria::orderBy('id_galeria')->get();

        
        return view('admin.galeria.index', compact('listaGaleria'));
    }
}