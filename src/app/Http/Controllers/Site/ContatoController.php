<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ContatoController extends Controller{

    //Método Contato - Carregar a pg CONTATO
    public function contato (){

        return view('site.contato.contato');
    
    }

}// FIM DA CLASS (TUDO VAI FICAR TUDO NA CLASS), UMA CLASSE PODE TER VARIOS PROCEDIMENTOS/METODOS