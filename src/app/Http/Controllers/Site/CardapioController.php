<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Produto;

class CardapioController extends Controller{

    //Método Cardápio - Carregar a pg CARDÁPIO
    public function cardapio (?int $idCategoria = null ){

      $listaCategoria = Categoria::where('status_categoria', 'ATIVO')->orderBy('nome_categoria')->get();

      //SE nenhuma caegoria estiver na url, ele vai trazer todos os produtos, caso contrário, ele vai trazer apenas os produtos da categoria selecionada

      if($idCategoria === null){
        $categoriaSelecionada = $listaCategoria->first();
        }else{
          $categoriaSelecionada = $listaCategoria->firstWhere('id_categoria', $idCategoria);
      }

      //Caso não tenha a categoria
      abort_if(!$categoriaSelecionada === null, 404, 'Categoria não encontrada');

      //buscar  somente os produtos relacionados a categoria
      $listaProduto = Produto::where('status_produto', 'ATIVO')->orderBy('nome_produto')->get();

      $produto = Produto::query()
      ->where('id_categoria', $categoriaSelecionada->id_categoria)
      ->where('status_produto', 'ATIVO')
      ->orderBy('nome_produto')
      ->get();
      
      //dd($produto); 

      //dd($listaCategoria);

      return view('site.cardapio.cardapio', compact('listaCategoria', 'listaProduto', 'produto', 'categoriaSelecionada'));
    
    }

}// FIM DA CLASS (TUDO VAI FICAR TUDO NA CLASS), UMA CLASSE PODE TER VARIOS PROCEDIMENTOS/METODOS
