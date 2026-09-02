<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;

class UsuariosController extends Controller
{   
    //Lista todos os usuários cadastrados
    public function index()
    {
        $listaUsuarios = Usuarios:: orderBy('id_usuarios')
            ->get();

        return view('admin.usuarios.index', compact('listaUsuarios'));
    }
}