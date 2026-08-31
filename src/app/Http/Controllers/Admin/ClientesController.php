<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;

class ClientesController extends Controller
{   
    //Lista todos os clientes cadastrados
    public function index()
    {
        $listaClientes = Cliente::orderBy('id_cliente')->get();

        
        return view('admin.clientes.index', compact('listaClientes'));
    }
}