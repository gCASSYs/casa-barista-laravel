<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GaleriaController extends Controller
{   
    //Lista todos os galérias cadastrados
    public function index()
    {
        $listaGaleria = Galeria::orderBy('id_galeria')->get();

        
        return view('admin.galeria.index', compact('listaGaleria'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_galeria' => 'required|string|max:50',
            'imagem_galeria' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_galeria' => 'required|in:ATIVO,INATIVO',
        ]);

        try {
            $galeria = Galeria::create([
                'nome_galeria' => $dados['nome_galeria'],
                'imagem_galeria' => 'galeria/sem-foto.png',
                'status_galeria' => $dados['status_galeria'],
            ]);
            $imagem = $dados['imagem_galeria'];
            $nome = Str::limit(Str::slug($dados['nome_galeria'], '_'), 42, '') . '_' . $galeria->id_galeria . '.' . $imagem->extension();
            $pasta = public_path('barista/assets/galeria');
            File::ensureDirectoryExists($pasta);
            $imagem->move($pasta, $nome);
            $galeria->update(['imagem_galeria' => 'galeria/' . $nome]);

            return redirect()->route('admin.galeria.index')->with('sucesso', 'Imagem cadastrada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return back()->withInput()->with('erro', 'Não foi possível cadastrar a imagem. Tente novamente.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'nome_galeria' => 'required|string|max:50',
            'imagem_galeria' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_galeria' => 'required|in:ATIVO,INATIVO',
        ]);
        $galeria = Galeria::findOrFail($id);

        try {
            $caminho = $galeria->imagem_galeria;
            if ($request->hasFile('imagem_galeria')) {
                $antiga = public_path('barista/assets/' . $galeria->imagem_galeria);
                if (File::exists($antiga)) unlink($antiga);
                $imagem = $request->file('imagem_galeria');
                $nome = Str::limit(Str::slug($dados['nome_galeria'], '_'), 42, '') . '_' . $galeria->id_galeria . '.' . $imagem->extension();
                $imagem->move(public_path('barista/assets/galeria'), $nome);
                $caminho = 'galeria/' . $nome;
            } elseif ($galeria->nome_galeria !== $dados['nome_galeria']) {
                // Renomeia a imagem atual quando somente o nome da galeria muda.
                $antiga = public_path('barista/assets/' . $galeria->imagem_galeria);
                $extensao = pathinfo($galeria->imagem_galeria, PATHINFO_EXTENSION);
                $nomeGaleria = Str::limit(Str::slug($dados['nome_galeria'], '_'), 42, '');
                $nome = $nomeGaleria . '_' . $galeria->id_galeria . '.' . $extensao;
                $nova = public_path('barista/assets/galeria/' . $nome);

                if (File::exists($antiga)) {
                    File::move($antiga, $nova);
                    $caminho = 'galeria/' . $nome;
                }
            }
            $galeria->update([
                'nome_galeria' => $dados['nome_galeria'],
                'imagem_galeria' => $caminho,
                'status_galeria' => $dados['status_galeria'],
            ]);
            return redirect()->route('admin.galeria.index')->with('sucesso', 'Imagem atualizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return back()->withInput()->with('erro', 'Não foi possível atualizar a imagem. Tente novamente.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $galeria = Galeria::findOrFail($id);
            $galeria->update(['status_galeria' => $galeria->status_galeria === 'ATIVO' ? 'INATIVO' : 'ATIVO']);
            return redirect()->route('admin.galeria.index')->with('sucesso', 'Status da imagem alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return back()->with('erro', 'Não foi possível alterar o status da imagem.');
        }
    }
}


