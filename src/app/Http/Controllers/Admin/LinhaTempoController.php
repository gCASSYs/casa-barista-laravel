<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinhaTempo;
use Illuminate\Http\Request;

class LinhaTempoController extends Controller
{   
    //Lista todas as linhas tempo cadastrados
    public function index()
    {
        $listaLinhaTempo = LinhaTempo::orderBy('id_linha_tempo')->get();

        
        return view('admin.linhatempo.index', compact('listaLinhaTempo'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo_linha_tempo' => 'required|string|max:30', 'ano_linha_tempo' => 'required|date',
            'descricao_linha_tempo' => 'required|string|max:255', 'status_linha_tempo' => 'required|in:ATIVO,INATIVO',
        ]);
        try {
            LinhaTempo::create($dados);
            return redirect()->route('admin.linhatempo.index')->with('sucesso', 'Linha do tempo cadastrada com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível cadastrar a linha do tempo.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'titulo_linha_tempo' => 'required|string|max:30', 'ano_linha_tempo' => 'required|date',
            'descricao_linha_tempo' => 'required|string|max:255', 'status_linha_tempo' => 'required|in:ATIVO,INATIVO',
        ]);
        try {
            LinhaTempo::findOrFail($id)->update($dados);
            return redirect()->route('admin.linhatempo.index')->with('sucesso', 'Linha do tempo atualizada com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível atualizar a linha do tempo.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $linha = LinhaTempo::findOrFail($id);
            $linha->update(['status_linha_tempo' => $linha->status_linha_tempo === 'ATIVO' ? 'INATIVO' : 'ATIVO']);
            return redirect()->route('admin.linhatempo.index')->with('sucesso', 'Status da linha do tempo alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->with('erro', 'Não foi possível alterar o status da linha do tempo.');
        }
    }
}



