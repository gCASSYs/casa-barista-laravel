<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{   
    //Lista de todas as news cadastrados
    public function index()
    {
        $listaNews = News::orderBy('id_news')->get();

        
        return view('admin.news.index', compact('listaNews'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate(['email_news' => 'required|email|max:80|unique:tbl_news,email_news', 'aceite_news' => 'required|in:0,1']);
        try {
            News::create($dados);
            return redirect()->route('admin.news.index')->with('sucesso', 'Newsletter cadastrada com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível cadastrar a newsletter.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate(['email_news' => 'required|email|max:80|unique:tbl_news,email_news,' . $id . ',id_news', 'aceite_news' => 'required|in:0,1']);
        try {
            News::findOrFail($id)->update($dados);
            return redirect()->route('admin.news.index')->with('sucesso', 'Newsletter atualizada com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível atualizar a newsletter.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $news = News::findOrFail($id);
            $news->update(['aceite_news' => $news->aceite_news == 1 ? 0 : 1]);
            return redirect()->route('admin.news.index')->with('sucesso', 'Aceite da newsletter alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->with('erro', 'Não foi possível alterar o aceite da newsletter.');
        }
    }
}



