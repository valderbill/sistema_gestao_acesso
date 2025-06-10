<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\AcessoLiberado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
{
    public function index()
    {
        // Carrega veículos com o relacionamento 'acesso' para evitar N+1
        $veiculos = Veiculo::with('acesso')->get();
        return view('veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        $acessos = AcessoLiberado::all();
<<<<<<< HEAD

        // Buscar apenas usuários ativos
        $usuariosAtivos = Usuario::where('ativo', true)->get();

        return view('veiculos.create', compact('acessos', 'usuariosAtivos'));
=======
        $usuarios = Usuario::where('ativo', true)->get();

        return view('veiculos.create', compact('acessos', 'usuarios'));
>>>>>>> 4718903 (10/06 correções)
    }

    public function store(Request $request)
    {
        // Normaliza campos para maiúsculas
        $request->merge([
            'placa' => strtoupper($request->placa),
            'modelo' => strtoupper($request->modelo),
            'cor' => strtoupper($request->cor),
            'tipo' => strtoupper($request->tipo),
            'marca' => strtoupper($request->marca),
            // Se usuário estiver logado, preenche id, senão null
            'usuario_logado_id' => auth()->check() ? auth()->id() : null,
        ]);

        // Validação dos dados, usuario_logado_id é opcional (nullable)
        $request->validate([
            'placa' => [
                'required',
                'string',
                'max:7',
                'regex:/^[A-Z]{3}[0-9]{4}$|^[A-Z]{3}[0-9][A-Z0-9][0-9]{2}$/',
            ],
            'modelo' => 'required|string|max:100',
            'cor' => 'required|string|max:50',
            'tipo' => 'required|in:OFICIAL,PARTICULAR,MOTO',
            'marca' => 'required|string|max:50',
            'acesso_id' => 'nullable|exists:acessos_liberados,id',
            'usuario_logado_id' => 'nullable|exists:usuarios,id',
        ], [
            'placa.regex' => 'Formato inválido para placa. Use ABC1234 (antigo) ou ABC1D23 (Mercosul).',
        ]);

        // Captura somente os dados necessários para o create
        $data = $request->only([
            'placa',
            'modelo',
            'cor',
            'tipo',
            'marca',
            'acesso_id',
            'usuario_logado_id',
        ]);

        Veiculo::create($data);

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso.');
    }

    public function show(Veiculo $veiculo)
    {
        return view('veiculos.show', compact('veiculo'));
    }

    public function edit(Veiculo $veiculo)
    {
        $acessos = AcessoLiberado::all();
<<<<<<< HEAD

        // Buscar apenas usuários ativos
        $usuariosAtivos = Usuario::where('ativo', true)->get();

        return view('veiculos.edit', compact('veiculo', 'acessos', 'usuariosAtivos'));
=======
        $usuarios = Usuario::where('ativo', true)->get();

        return view('veiculos.edit', compact('veiculo', 'acessos', 'usuarios'));
>>>>>>> 4718903 (10/06 correções)
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        // Forçar maiúsculas nos campos antes da validação
        $request->merge([
            'placa' => strtoupper($request->placa),
            'modelo' => strtoupper($request->modelo),
            'cor' => strtoupper($request->cor),
            'tipo' => strtoupper($request->tipo),
            'marca' => strtoupper($request->marca),
            // Mesmo controle para update, se quiser
            'usuario_logado_id' => auth()->check() ? auth()->id() : null,
        ]);

        $request->validate([
            'placa' => [
                'required',
                'string',
                'max:7',
                'regex:/^[A-Z]{3}[0-9]{4}$|^[A-Z]{3}[0-9][A-Z0-9][0-9]{2}$/',
            ],
            'modelo' => 'required|string|max:100',
            'cor' => 'required|string|max:50',
            'tipo' => 'required|in:OFICIAL,PARTICULAR,MOTO',
            'marca' => 'required|string|max:50',
            'acesso_id' => 'nullable|exists:acessos_liberados,id',
            'usuario_logado_id' => 'nullable|exists:usuarios,id',
        ], [
            'placa.regex' => 'Formato inválido para placa. Use ABC1234 (antigo) ou ABC1D23 (Mercosul).',
        ]);

        $data = $request->only([
            'placa',
            'modelo',
            'cor',
            'tipo',
            'marca',
            'acesso_id',
            'usuario_logado_id',
        ]);

        $veiculo->update($data);

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso.');
    }

    public function destroy(Veiculo $veiculo)
    {
        // Verifica se há ocorrências relacionadas antes de deletar
        $temOcorrencias = DB::table('ocorrencias')->where('placa', $veiculo->placa)->exists();

        if ($temOcorrencias) {
            return redirect()->route('veiculos.index')
                ->with('error', 'O veículo não pode ser deletado porque possui ocorrências geradas.');
        }

        $veiculo->delete();

        return redirect()->route('veiculos.index')
            ->with('success', 'Veículo excluído com sucesso.');
    }

    public function buscarPorPlaca($placa)
    {
        $placa = strtoupper($placa);

        $veiculo = Veiculo::where('placa', $placa)->first();

        if ($veiculo) {
            return response()->json([
                'success' => true,
                'data' => [
                    'modelo' => $veiculo->modelo,
                    'cor' => $veiculo->cor,
                    'tipo' => $veiculo->tipo,
                    'marca' => $veiculo->marca,
                    'acesso_id' => $veiculo->acesso_id,
                ],
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Veículo não encontrado.']);
    }
}
