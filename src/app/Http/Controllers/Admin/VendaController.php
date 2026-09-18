<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VendaController extends Controller
{   
    //Lista todas as vendas cadastradas
    public function index()
    {
        $listaVenda = Venda::with('cliente')
            ->orderBy('id_venda')
            ->get();
        $listaClientes = Cliente::orderBy('nome_cliente')->get();

        
        return view('admin.venda.index', compact('listaVenda', 'listaClientes'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_cliente' => 'required|exists:tbl_cliente,id_cliente', 'data_hora_venda' => 'required|date',
            'valor_total_venda' => 'required|numeric|min:0', 'forma_pagamento_venda' => 'required|string|max:10',
            'observacao_venda' => 'required|string|max:100', 'status_venda' => 'required|in:EM ANDAMENTO,FINALIZADA,CANCELADA',
        ]);
        try {
            Venda::create($dados);
            return redirect()->route('admin.venda.index')->with('sucesso', 'Venda cadastrada com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível cadastrar a venda.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'id_cliente' => 'required|exists:tbl_cliente,id_cliente', 'data_hora_venda' => 'required|date',
            'valor_total_venda' => 'required|numeric|min:0', 'forma_pagamento_venda' => 'required|string|max:10',
            'observacao_venda' => 'required|string|max:100', 'status_venda' => 'required|in:EM ANDAMENTO,FINALIZADA,CANCELADA',
        ]);
        try {
            Venda::findOrFail($id)->update($dados);
            return redirect()->route('admin.venda.index')->with('sucesso', 'Venda atualizada com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível atualizar a venda.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $venda = Venda::findOrFail($id);
            $venda->update(['status_venda' => $venda->status_venda === 'FINALIZADA' ? 'EM ANDAMENTO' : 'FINALIZADA']);
            return redirect()->route('admin.venda.index')->with('sucesso', 'Status da venda alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->with('erro', 'Não foi possível alterar o status da venda.');
        }
    }
}



