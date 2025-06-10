<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
<<<<<<< HEAD
    // Listagem completa para o administrador, mostra todos (ativos e inativos)
=======
    // Lista usuários para o administrador — aqui você mostra TODOS, ativo ou inativo,
    // para que possa gerenciar (editar, ativar/inativar)
>>>>>>> 4718903 (10/06 correções)
    public function index()
    {
        $usuarios = Usuario::with('perfil')->get(); // TODOS os usuários, sem filtro
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $perfis = Perfil::all();
        return view('usuarios.create', compact('perfis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'matricula' => 'required|string|max:100|unique:usuarios,matricula',
            'senha' => 'required|string|min:6',
            'perfil_id' => 'required|exists:perfis,id',
<<<<<<< HEAD
=======
            'ativo' => 'required|boolean',
>>>>>>> 4718903 (10/06 correções)
        ]);

        Usuario::create([
            'nome' => $request->nome,
            'matricula' => $request->matricula,
            'senha' => Hash::make($request->senha),
            'perfil_id' => $request->perfil_id,
<<<<<<< HEAD
            'ativo' => true,
=======
            'ativo' => $request->ativo,
>>>>>>> 4718903 (10/06 correções)
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        $perfis = Perfil::all();
        return view('usuarios.edit', compact('usuario', 'perfis'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'matricula' => 'required|string|max:100|unique:usuarios,matricula,' . $usuario->id,
            'perfil_id' => 'required|exists:perfis,id',
<<<<<<< HEAD
=======
            'ativo' => 'required|boolean',
>>>>>>> 4718903 (10/06 correções)
        ]);

        $usuario->nome = $request->nome;
        $usuario->matricula = $request->matricula;
        $usuario->perfil_id = $request->perfil_id;
        $usuario->ativo = $request->ativo;

        if ($request->filled('senha')) {
            $request->validate(['senha' => 'string|min:6']);
            $usuario->senha = Hash::make($request->senha);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

<<<<<<< HEAD
    // Atualiza status ativo/inativo
    public function toggleStatus(Request $request, $id)
    {
        $request->validate(['ativo' => 'required|boolean']);

        $usuario = Usuario::findOrFail($id);
        $usuario->ativo = $request->input('ativo');
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Status do usuário atualizado com sucesso.');
    }

    // Nova função para resetar senha para a matrícula
    public function resetSenha($id)
    {
        $usuario = Usuario::findOrFail($id);
        $novaSenha = $usuario->matricula;

        $usuario->senha = Hash::make($novaSenha);
        $usuario->save();

        // Redireciona para a listagem com mensagem e nova senha
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Senha redefinida com sucesso para o usuário: ' . $usuario->nome)
            ->with('novaSenha', $novaSenha)
            ->with('usuarioId', $usuario->id);
=======
    // Remover exclusão conforme solicitado
    // public function destroy(Usuario $usuario) {}

    // Alterna status conforme o form (input radio)
    public function alternarStatus(Request $request, Usuario $usuario)
    {
        $ativo = $request->input('ativo');
        $usuario->ativo = $ativo == '1';
        $usuario->save();

        $status = $usuario->ativo ? 'ativado' : 'inativado';

        return redirect()->route('usuarios.index')->with('success', "Usuário {$status} com sucesso.");
>>>>>>> 4718903 (10/06 correções)
    }
}
