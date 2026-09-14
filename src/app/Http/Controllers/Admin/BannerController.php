<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            'titulo_banner' => 'required|string|max:50',
            'imagem_banner' => 'required|image|max:5120',
            'status_banner' => 'required|in:ATIVO,INATIVO',
        ]);

        // 2 - Receber a imagem enviada
        $imagem = $dados['imagem_banner'];

        // 3 - Gerar o nome do arquivo a partir do título do banner
        $nomeImg = Str::slug($dados['titulo_banner']) . '.' . $imagem->extension();

        // 4 - Mover a imagem para public/barista/assets/banner
        $diretorioBanner = public_path('barista/assets/banner');
        File::ensureDirectoryExists($diretorioBanner);

        if (File::exists($diretorioBanner . '/' . $nomeImg)) {
            return back()->withErrors([
                'titulo_banner' => 'Já existe uma imagem cadastrada com este título.',
            ])->withInput();
        }

        $imagem->move($diretorioBanner, $nomeImg);

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

/*
    O que foi ajustado no cadastro de banner:

    1. O título agora aceita no máximo 50 caracteres, pois este é o limite
       da coluna titulo_banner no banco de dados.

    2. A imagem aceita no máximo 5 MB. Isso evita o envio de arquivos muito
       grandes e mantém o limite igual ao configurado no servidor.

    3. O nome da imagem é criado a partir do título do banner.
       Exemplo: "Café Fresco e Especial" vira "cafe-fresco-e-especial.jpg".
       Str::slug() remove acentos, espaços e caracteres especiais para que
       o nome funcione corretamente como arquivo e URL.

    4. File::ensureDirectoryExists() garante que a pasta banner exista antes
       de tentar salvar a imagem nela.

    5. Antes de salvar, o sistema verifica se já existe uma imagem com o
       mesmo nome. Se existir, ele não sobrescreve o arquivo antigo e mostra
       uma mensagem para informar que o título já foi usado.
*/
