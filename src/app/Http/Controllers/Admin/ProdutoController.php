<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;

class ProdutoController extends Controller
{   
    //Lista todos os produtos cadastrados
    public function index()
    {
        $listaProduto = Produto::orderBy('id_produto')->get();

        
        return view('admin.produto.index', compact('listaProduto'));
    }
}