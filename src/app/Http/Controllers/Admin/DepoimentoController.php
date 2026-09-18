<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depoimento;
use App\Models\Cliente;
use Illuminate\Http\Request;

class DepoimentoController extends Controller
{   
    //Lista todos os depoimentos cadastrados
    public function index()
    {
        $listaDepoimento = Depoimento::with('DepoimentoCliente')
            ->orderBy('id_depoimento')
            ->get();
        $listaClientes = Cliente::orderBy('nome_cliente')->get();

        
        return view('admin.depoimento.index', compact('listaDepoimento', 'listaClientes'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_cliente' => 'required|exists:tbl_cliente,id_cliente', 'titulo_depoimento' => 'required|string|max:50',
            'descricao_depoimento' => 'required|string', 'nota_depoimento' => 'required|integer|min:1|max:5',
            'status_depoimento' => 'required|in:PENDENTE,APROVADO,REPROVADO',
        ]);
        try {
            Depoimento::create($dados);
            return redirect()->route('admin.depoimento.index')->with('sucesso', 'Depoimento cadastrado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível cadastrar o depoimento.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'id_cliente' => 'required|exists:tbl_cliente,id_cliente', 'titulo_depoimento' => 'required|string|max:50',
            'descricao_depoimento' => 'required|string', 'nota_depoimento' => 'required|integer|min:1|max:5',
            'status_depoimento' => 'required|in:PENDENTE,APROVADO,REPROVADO',
        ]);
        try {
            Depoimento::findOrFail($id)->update($dados);
            return redirect()->route('admin.depoimento.index')->with('sucesso', 'Depoimento atualizado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível atualizar o depoimento.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $depoimento = Depoimento::findOrFail($id);
            $novoStatus = $depoimento->status_depoimento === 'APROVADO' ? 'REPROVADO' : 'APROVADO';
            $depoimento->update(['status_depoimento' => $novoStatus]);
            return redirect()->route('admin.depoimento.index')->with('sucesso', 'Status do depoimento alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->with('erro', 'Não foi possível alterar o status do depoimento.');
        }
    }
}



