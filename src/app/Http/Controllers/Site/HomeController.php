<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HomeController extends Controller{

    //Método Home - Carregar a INDEX (HOME)
    public function home (){

        return view('site.home.home');
    
    }

}// FIM DA CLASS (TUDO VAI FICAR TUDO NA CLASS), UMA CLASSE PODE TER VARIOS PROCEDIMENTOS/METODOS