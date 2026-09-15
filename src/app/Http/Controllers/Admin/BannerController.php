<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

        //dd($request);
        // 1 - Validação dos dados recebidos do formulário
        $dados = $request->validate([
            'titulo_banner' => 'required|string|max:50',
            'imagem_banner' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_banner' => 'required|in:ATIVO,INATIVO',
        ]);

        // Impede o cadastro de dois banners com o mesmo título.
        if (Banner::where('titulo_banner', $dados['titulo_banner'])->exists()) {
            return back()->withErrors([
                'titulo_banner' => 'Já existe um banner cadastrado com este título.',
            ])->withInput();
        }

        // Caminho usado para apagar a imagem se algo falhar.
        $caminhoArquivo = null;

        try {
            // Inicia a transação do banco.
            DB::beginTransaction();

            // 2 - Cria o banner para obter seu ID.
            $banner = Banner::create([
                'titulo_banner' => $dados['titulo_banner'],
                // Será substituído pelo caminho final da imagem.
                'imagem_banner' => 'banner/sem-foto.png',
                'status_banner' => $dados['status_banner'],
            ]);

            // 3 - Receber a imagem enviada
            $imagem = $dados['imagem_banner'];

            // 4 - Cria o nome com título seguro e ID.
            // Exemplo: "Café Mineiro" vira "cafe_mineiro_6.png".
            // O limite respeita os 65 caracteres da coluna imagem_banner.
            $tituloImg = Str::limit(Str::slug($dados['titulo_banner'], '_'), 42, '');
            $nomeImg = $tituloImg . '_' . $banner->id_banner . '.' . $imagem->extension();

            // 5 - Salvar a imagem
            $diretorioBanner = public_path('barista/assets/banner');
            // Cria a pasta se ela não existir.
            File::ensureDirectoryExists($diretorioBanner);
            $imagem->move($diretorioBanner, $nomeImg);
            $caminhoArquivo = $diretorioBanner . DIRECTORY_SEPARATOR . $nomeImg;

            // 6 - Salva no banco o caminho final da imagem.
            $banner->imagem_banner = 'banner/' . $nomeImg;
            $banner->save();

            // Confirma as alterações no banco.
            DB::commit();

            // 7 - Redirecionar para a página de listagem com mensagem de sucesso
            return redirect()->route('admin.banner.index')->with('sucesso', 'Banner: ' . $banner->titulo_banner . ' foi cadastrado com sucesso!');

        } catch (\Throwable $th) {
            // Desfaz o cadastro no banco se houver erro.
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            // Apaga a imagem se ela já tiver sido salva.
            if ($caminhoArquivo && File::exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            // Registra os detalhes técnicos no log do Laravel.
            report($th);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o banner. Tente novamente.');
        }
    }

}

/*
    ERRO E AJUSTE DO CADASTRO DE BANNER

    O erro acontecia ao tentar cadastrar um novo banner porque o sistema
    usava o título e o nome original da imagem diretamente como nome do
    arquivo. Títulos podem ter espaços, acentos e caracteres especiais;
    isso pode gerar nomes de arquivo inválidos ou difíceis de acessar pela URL.
    Também ocorria erro se a pasta "public/barista/assets/banner" não existisse.

    Para corrigir:
    1. Limitamos o título a 50 caracteres, que é o mesmo limite da coluna
       titulo_banner no banco de dados. Assim, o banco não recebe um título maior
       do que consegue salvar.

    2. Limitamos a imagem a 4 MB para evitar arquivos muito grandes.

    3. Usamos Str::slug() para transformar o título em um nome seguro.
       Exemplo: "Café Fresco e Especial" vira "cafe-fresco-e-especial.jpg".

    4. Usamos File::ensureDirectoryExists() para criar a pasta de banners
       automaticamente antes de mover a imagem.

    5. O ID é incluído no nome do arquivo para ele não se repetir.

    6. A transação e o try/catch desfazem o cadastro e removem a imagem se falhar.
*/
