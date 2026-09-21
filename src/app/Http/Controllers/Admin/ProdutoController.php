<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    public function __construct(private readonly ImageProcessor $imageProcessor) {}

    //Lista todos os produtos cadastrados
    public function index()
    {
        $listaProduto = Produto::with('categoria')->orderBy('id_produto')->get();
        $listaCategoria = Categoria::orderBy('nome_categoria')->get();

        
        return view('admin.produto.index', compact('listaProduto', 'listaCategoria'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_produto' => 'required|string|max:30', 'id_categoria' => 'required|exists:tbl_categoria,id_categoria',
            'descricao_curta_produto' => 'required|string|max:100', 'descricao_longa_produto' => 'nullable|string',
            'valor_produto' => 'required|numeric|min:0', 'imagem_produto' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'destaque_produto' => 'required|in:0,1', 'status_produto' => 'required|in:ATIVO,INATIVO',
        ]);
        $arquivoSalvo = null;
        try {
            DB::beginTransaction();
            $produto = Produto::create(array_merge($dados, ['imagem_produto' => 'produto/sem-foto.png']));
            $imagem = $request->file('imagem_produto');
            // Usa o nome do produto no arquivo, junto com o ID para não repetir.
            $nomeProduto = Str::limit(Str::slug($dados['nome_produto'], '_'), 20, '');
            $nome = $nomeProduto . '_' . $produto->id_produto . '.' . $imagem->extension();
            File::ensureDirectoryExists(public_path('barista/assets/produto'));
            $this->imageProcessor->cover($imagem, public_path('barista/assets/produto/' . $nome), 960, 480);
            $arquivoSalvo = public_path('barista/assets/produto/' . $nome);
            $produto->update(['imagem_produto' => 'produto/' . $nome]);
            DB::commit();
            return redirect()->route('admin.produto.index')->with('sucesso', 'Produto cadastrado com sucesso!');
        } catch (\Throwable $th) {
            if (DB::transactionLevel() > 0) DB::rollBack();
            if ($arquivoSalvo && File::exists($arquivoSalvo)) File::delete($arquivoSalvo);
            report($th); return back()->withInput()->with('erro', 'Não foi possível cadastrar o produto.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'nome_produto' => 'required|string|max:30', 'id_categoria' => 'required|exists:tbl_categoria,id_categoria',
            'descricao_curta_produto' => 'required|string|max:100', 'descricao_longa_produto' => 'nullable|string',
            'valor_produto' => 'required|numeric|min:0', 'imagem_produto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'destaque_produto' => 'required|in:0,1', 'status_produto' => 'required|in:ATIVO,INATIVO',
        ]);
        $produto = Produto::findOrFail($id);
        try {
            $caminho = $produto->imagem_produto;
            if ($request->hasFile('imagem_produto')) {
                $antiga = public_path('barista/assets/' . $produto->imagem_produto);
                $imagem = $request->file('imagem_produto');
                $nomeProduto = Str::limit(Str::slug($dados['nome_produto'], '_'), 20, '');
                $nome = $nomeProduto . '_' . $produto->id_produto . '.' . $imagem->extension();
                File::ensureDirectoryExists(public_path('barista/assets/produto'));
                $nova = public_path('barista/assets/produto/' . $nome);
                $this->imageProcessor->cover($imagem, $nova, 960, 480);
                if ($antiga !== $nova && File::exists($antiga)) File::delete($antiga);
                $caminho = 'produto/' . $nome;
            } elseif ($produto->nome_produto !== $dados['nome_produto']) {
                // Renomeia a imagem atual quando somente o nome do produto muda.
                $antiga = public_path('barista/assets/' . $produto->imagem_produto);
                $extensao = pathinfo($produto->imagem_produto, PATHINFO_EXTENSION);
                $nomeProduto = Str::limit(Str::slug($dados['nome_produto'], '_'), 20, '');
                $nome = $nomeProduto . '_' . $produto->id_produto . '.' . $extensao;
                $nova = public_path('barista/assets/produto/' . $nome);

                if (File::exists($antiga)) {
                    File::move($antiga, $nova);
                    $caminho = 'produto/' . $nome;
                }
            }
            $dados['imagem_produto'] = $caminho;
            $produto->update($dados);
            return redirect()->route('admin.produto.index')->with('sucesso', 'Produto atualizado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível atualizar o produto.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $produto = Produto::findOrFail($id);
            $produto->update(['status_produto' => $produto->status_produto === 'ATIVO' ? 'INATIVO' : 'ATIVO']);
            return redirect()->route('admin.produto.index')->with('sucesso', 'Status do produto alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->with('erro', 'Não foi possível alterar o status do produto.');
        }
    }
}
