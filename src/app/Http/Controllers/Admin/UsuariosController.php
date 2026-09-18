<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuariosController extends Controller
{   
    //Lista todos os usuários cadastrados
    public function index()
    {
        $listaUsuarios = Usuarios:: orderBy('id_usuarios')
            ->get();

        return view('admin.usuarios.index', compact('listaUsuarios'));
    }

    // Cadastra um novo registro enviado pelo modal.
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_usuarios' => 'required|string|max:50', 'email_usuarios' => 'required|email|max:80|unique:tbl_usuarios,email_usuarios',
            'senha_usuarios' => 'required|string|min:6', 'foto_usuarios' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'nivel_usuarios' => 'required|string|max:15', 'status_usuarios' => 'required|in:ATIVO,INATIVO',
        ]);
        try {
            $usuario = Usuarios::create(array_merge($dados, ['senha_usuarios' => Hash::make($dados['senha_usuarios']), 'foto_usuarios' => 'usuarios/sem-foto.png']));
            $imagem = $request->file('foto_usuarios');
            // Usa o nome do usuário no arquivo, junto com o ID para não repetir.
            $nomeUsuario = Str::limit(Str::slug($dados['nome_usuarios'], '_'), 37, '');
            $nome = $nomeUsuario . '_' . $usuario->id_usuarios . '.' . $imagem->extension();
            File::ensureDirectoryExists(public_path('barista/assets/usuarios'));
            $imagem->move(public_path('barista/assets/usuarios'), $nome);
            $usuario->update(['foto_usuarios' => 'usuarios/' . $nome]);
            return redirect()->route('admin.usuarios.index')->with('sucesso', 'Usuário cadastrado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível cadastrar o usuário.');
        }
    }

    // Atualiza os dados do registro escolhido no modal de edição.
    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'nome_usuarios' => 'required|string|max:50', 'email_usuarios' => 'required|email|max:80|unique:tbl_usuarios,email_usuarios,' . $id . ',id_usuarios',
            'senha_usuarios' => 'nullable|string|min:6', 'foto_usuarios' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'nivel_usuarios' => 'required|string|max:15', 'status_usuarios' => 'required|in:ATIVO,INATIVO',
        ]);
        $usuario = Usuarios::findOrFail($id);
        try {
            $dados['foto_usuarios'] = $usuario->foto_usuarios;
            $dados['senha_usuarios'] = $dados['senha_usuarios'] ? Hash::make($dados['senha_usuarios']) : $usuario->senha_usuarios;
            if ($request->hasFile('foto_usuarios')) {
                $antiga = public_path('barista/assets/' . $usuario->foto_usuarios);
                if (File::exists($antiga)) unlink($antiga);
                $imagem = $request->file('foto_usuarios');
                $nomeUsuario = Str::limit(Str::slug($dados['nome_usuarios'], '_'), 37, '');
                $nome = $nomeUsuario . '_' . $usuario->id_usuarios . '.' . $imagem->extension();
                $imagem->move(public_path('barista/assets/usuarios'), $nome);
                $dados['foto_usuarios'] = 'usuarios/' . $nome;
            } elseif ($usuario->nome_usuarios !== $dados['nome_usuarios']) {
                // Renomeia a foto atual quando somente o nome do usuário muda.
                $antiga = public_path('barista/assets/' . $usuario->foto_usuarios);
                $extensao = pathinfo($usuario->foto_usuarios, PATHINFO_EXTENSION);
                $nomeUsuario = Str::limit(Str::slug($dados['nome_usuarios'], '_'), 37, '');
                $nome = $nomeUsuario . '_' . $usuario->id_usuarios . '.' . $extensao;
                $nova = public_path('barista/assets/usuarios/' . $nome);

                if (File::exists($antiga)) {
                    File::move($antiga, $nova);
                    $dados['foto_usuarios'] = 'usuarios/' . $nome;
                }
            }
            $usuario->update($dados);
            return redirect()->route('admin.usuarios.index')->with('sucesso', 'Usuário atualizado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->withInput()->with('erro', 'Não foi possível atualizar o usuário.');
        }
    }

    // Altera somente o status do registro.
    public function status(int $id)
    {
        try {
            $usuario = Usuarios::findOrFail($id);
            $usuario->update(['status_usuarios' => $usuario->status_usuarios === 'ATIVO' ? 'INATIVO' : 'ATIVO']);
            return redirect()->route('admin.usuarios.index')->with('sucesso', 'Status do usuário alterado com sucesso!');
        } catch (\Throwable $th) {
            report($th); return back()->with('erro', 'Não foi possível alterar o status do usuário.');
        }
    }
}


