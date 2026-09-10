<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{   
    //Lista todos os banners cadastrados
    public function index()
    {
        $listaBanner = Banner::orderBy('id_banner')->get();

        
        return view('admin.banner.index', compact('listaBanner'));
    }

    //Cadastra um novo banner
    public function store(Request $request)
    {

        // 1 - Validação dos dados recebidos do formulário
        $dados = $request->validate([
            'titulo_banner' => 'required|string|max:255',
            'imagem_banner' => 'required|image',
            'status_banner' => 'required|in:ATIVO,INATIVO',
        ]);

        // 2 - Receber a imagem enviada
        $imagem = $dados['imagem_banner'];

        // 3 - Renomear a imagem com o título e o nome original
        $titulo = $dados['titulo_banner'];
        $nomeImg = $titulo . '_' . $imagem->getClientOriginalName();

        // 4 - Mover a imagem para public/barista/assets/banner
        $imagem->move(public_path('barista/assets/banner'), $nomeImg);

        // 5 - Cadastrar no banco de dados
        Banner::create([
            'titulo_banner' => $dados['titulo_banner'],
            'imagem_banner' => 'banner/' . $nomeImg,
            'status_banner' => $dados['status_banner'],

        ]);

        // 6 - Redirecionar para a página de listagem de banners com uma mensagem de sucesso
        return redirect()->route('admin.banner.index')->with('sucesso', 'Banner cadastrado com sucesso!');
    }

}
