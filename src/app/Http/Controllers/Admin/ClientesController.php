<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientesController extends Controller
{   
    //Lista todos os clientes cadastrados
    public function index()
    {
        $listaClientes = Cliente::orderBy('id_cliente')->get();

        
        return view('admin.clientes.index', compact('listaClientes'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_cliente' => 'required|string|max:50', 'email_cliente' => 'required|email|max:80|unique:tbl_cliente,email_cliente',
            'senha_cliente' => 'required|string|min:6', 'foto_cliente' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_cliente' => 'required|in:ATIVO,INATIVO',
        ]);
        try {
            $cliente = Cliente::create(array_merge($dados, ['senha_cliente' => Hash::make($dados['senha_cliente']), 'foto_cliente' => 'cliente/sem-foto.png']));
            $imagem = $request->file('foto_cliente');
            // Usa o nome do cliente no arquivo, junto com o ID para não repetir.
            $nomeCliente = Str::limit(Str::slug($dados['nome_cliente'], '_'), 38, '');
            $nome = $nomeCliente . '_' . $cliente->id_cliente . '.' . $imagem->extension();
            File::ensureDirectoryExists(public_path('barista/assets/cliente'));
            $imagem->move(public_path('barista/assets/cliente'), $nome);
            $cliente->update(['foto_cliente' => 'cliente/' . $nome]);
            return redirect()->route('admin.clientes.index')->with('sucesso', 'Cliente cadastrado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível cadastrar o cliente.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'nome_cliente' => 'required|string|max:50', 'email_cliente' => 'required|email|max:80|unique:tbl_cliente,email_cliente,' . $id . ',id_cliente',
            'senha_cliente' => 'nullable|string|min:6', 'foto_cliente' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_cliente' => 'required|in:ATIVO,INATIVO',
        ]);
        $cliente = Cliente::findOrFail($id);
        try {
            $dados['foto_cliente'] = $cliente->foto_cliente;
            $dados['senha_cliente'] = $dados['senha_cliente'] ? Hash::make($dados['senha_cliente']) : $cliente->senha_cliente;
            if ($request->hasFile('foto_cliente')) {
                $antiga = public_path('barista/assets/' . $cliente->foto_cliente);
                if (File::exists($antiga)) unlink($antiga);
                $imagem = $request->file('foto_cliente');
                $nomeCliente = Str::limit(Str::slug($dados['nome_cliente'], '_'), 38, '');
                $nome = $nomeCliente . '_' . $cliente->id_cliente . '.' . $imagem->extension();
                $imagem->move(public_path('barista/assets/cliente'), $nome);
                $dados['foto_cliente'] = 'cliente/' . $nome;
            } elseif ($cliente->nome_cliente !== $dados['nome_cliente']) {
                // Renomeia a foto atual quando somente o nome do cliente muda.
                $antiga = public_path('barista/assets/' . $cliente->foto_cliente);
                $extensao = pathinfo($cliente->foto_cliente, PATHINFO_EXTENSION);
                $nomeCliente = Str::limit(Str::slug($dados['nome_cliente'], '_'), 38, '');
                $nome = $nomeCliente . '_' . $cliente->id_cliente . '.' . $extensao;
                $nova = public_path('barista/assets/cliente/' . $nome);

                if (File::exists($antiga)) {
                    File::move($antiga, $nova);
                    $dados['foto_cliente'] = 'cliente/' . $nome;
                }
            }
            $cliente->update($dados);
            return redirect()->route('admin.clientes.index')->with('sucesso', 'Cliente atualizado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível atualizar o cliente.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update(['status_cliente' => $cliente->status_cliente === 'ATIVO' ? 'INATIVO' : 'ATIVO']);
            return redirect()->route('admin.clientes.index')->with('sucesso', 'Status do cliente alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->with('erro', 'Não foi possível alterar o status do cliente.');
        }
    }
}


