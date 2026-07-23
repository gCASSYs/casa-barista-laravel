<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class EventosController extends Controller{

    //Método Eventos - Carregar a pg EVENTOS
    public function eventos (){

        return view('site.eventos.eventos');
    
    }

}// FIM DA CLASS (TUDO VAI FICAR TUDO NA CLASS), UMA CLASSE PODE TER VARIOS PROCEDIMENTOS/METODOS