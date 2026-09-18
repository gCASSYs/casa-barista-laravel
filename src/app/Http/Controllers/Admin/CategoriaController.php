<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{   
    //Lista todos os banners cadastrados
    public function index()
    {
        $listaCategoria = Categoria::orderBy('id_categoria')->get();

        
        return view('admin.categoria.index', compact('listaCategoria'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate(['nome_categoria' => 'required|string|max:30', 'status_categoria' => 'required|in:ATIVO,INATIVO']);
        try {
            Categoria::create($dados);
            return redirect()->route('admin.categoria.index')->with('sucesso', 'Categoria cadastrada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return back()->withInput()->with('erro', 'Não foi possível cadastrar a categoria.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate(['nome_categoria' => 'required|string|max:30', 'status_categoria' => 'required|in:ATIVO,INATIVO']);
        try {
            Categoria::findOrFail($id)->update($dados);
            return redirect()->route('admin.categoria.index')->with('sucesso', 'Categoria atualizada com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return back()->withInput()->with('erro', 'Não foi possível atualizar a categoria.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->update(['status_categoria' => $categoria->status_categoria === 'ATIVO' ? 'INATIVO' : 'ATIVO']);
            return redirect()->route('admin.categoria.index')->with('sucesso', 'Status da categoria alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th);
            return back()->with('erro', 'Não foi possível alterar o status da categoria.');
        }
    }
}



