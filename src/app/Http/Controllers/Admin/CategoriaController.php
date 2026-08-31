<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;

class CategoriaController extends Controller
{   
    //Lista todos os banners cadastrados
    public function index()
    {
        $listaCategoria = Categoria::orderBy('id_categoria')->get();

        
        return view('admin.categoria.index', compact('listaCategoria'));
    }
}