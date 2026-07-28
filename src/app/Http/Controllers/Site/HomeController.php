<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Depoimento;

class HomeController extends Controller{


    // Metodo HOME - Carregar a INDEX (HOME)
    public function home(){


        //Busque a lista de banner para exibir na Home (Views)
        $listaBanner = Banner::where('status_banner', 'ATIVO')->inRandomOrder()->get();

        //dd($listaBanner);
        //var_dump($listaBanner);

        //buscar os depoimentos de clientes para exibir na home
        $listaDepo = Depoimento::with('DepoimentoCliente')->where('status_depoimento', 'APROVADO')->orderByDesc('id_depoimento')->get();
        
        
        return view('site.home.home', compact('listaBanner', 'listaDepo'));

    }
}    