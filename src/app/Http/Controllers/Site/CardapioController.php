<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class CardapioController extends Controller{

    //Método Cardápio - Carregar a pg CARDÁPIO
    public function cardapio (){

        return view('site.cardapio.cardapio');
    
    }

}// FIM DA CLASS (TUDO VAI FICAR TUDO NA CLASS), UMA CLASSE PODE TER VARIOS PROCEDIMENTOS/METODOS