<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;


class AdminController extends Controller{


    // Metodo DASH - Carregar a INDEX (DASH)
    public function dashboard(){
          
        //quantidade de clientes ativo
        $qtdClientes = Cliente::where('status_cliente', 'ativo')->count();
        //Quantidade total de produtos ativos
        $qtdProduto = Produto::where('status_produto', 'ativo')->count();
        //qUANTIDADE TOTAL DE PRODUTOS EM destaque
        $qtdProdutosDestaque = Produto::where('destaque_produto', 1)->count();
        //Valor total de vendas
        $valorTotalVendas = Venda::where('status_venda', 'FINALIZADA')->sum('valor_total_venda');




       return view('admin.dashboard', compact('qtdClientes', 'qtdProduto', 'qtdProdutosDestaque', 'valorTotalVendas'));

    }
}    