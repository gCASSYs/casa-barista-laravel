<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class SobreController extends Controller{

    //Método Sobre - Carregar a pg SOBRE
    public function sobre (){

        return view('site.sobre.sobre');
    
    }

}// FIM DA CLASS (TUDO VAI FICAR TUDO NA CLASS), UMA CLASSE PODE TER VARIOS PROCEDIMENTOS/METODOS