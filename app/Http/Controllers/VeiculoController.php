<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\AcessoLiberado;
use App\Models\Usuario;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::with('acesso')->get();
        return view('veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        $acessos = AcessoLiberado::all();

        // Buscar apenas usuários ativos
        $usuariosAtivos = Usuario::where('ativo', true)->get();

        return view('veiculos.create', compact('acessos', 'usuariosAtivos'));
    }

    public function store(Request $request)
    {
        // Forçar maiúsculas nos campos antes da validação
        $request->merge([
            'placa' => $request->has('placa') ? strtoupper($request->placa) : null,
            'modelo' => $request->has('modelo') ? strtoupper($request->modelo) : null,
            'cor' => $request->has('cor') ? strtoupper($request->cor) : null,
            'tipo' => $request->has('tipo') ? strtoupper($request->tipo) : null,
            'marca' => $request->has('marca') ? strtoupper($request->marca) : null,
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
        ], [
            'placa.regex' => 'Formato inválido para placa. Use ABC1234 (antigo) ou ABC1D23 (Mercosul).',
        ]);

        $data = $request->only(['placa', 'modelo', 'cor', 'tipo', 'marca', 'acesso_id']);

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

        // Buscar apenas usuários ativos
        $usuariosAtivos = Usuario::where('ativo', true)->get();

        return view('veiculos.edit', compact('veiculo', 'acessos', 'usuariosAtivos'));
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        // Forçar maiúsculas nos campos antes da validação
        $request->merge([
            'placa' => $request->has('placa') ? strtoupper($request->placa) : null,
            'modelo' => $request->has('modelo') ? strtoupper($request->modelo) : null,
            'cor' => $request->has('cor') ? strtoupper($request->cor) : null,
            'tipo' => $request->has('tipo') ? strtoupper($request->tipo) : null,
            'marca' => $request->has('marca') ? strtoupper($request->marca) : null,
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
        ], [
            'placa.regex' => 'Formato inválido para placa. Use ABC1234 (antigo) ou ABC1D23 (Mercosul).',
        ]);

        $data = $request->only(['placa', 'modelo', 'cor', 'tipo', 'marca', 'acesso_id']);

        $veiculo->update($data);

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso.');
    }

    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();
        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso.');
    }

    /**
     * Busca veículo pelo número da placa (para preenchimento automático no formulário via AJAX).
     *
     * @param string $placa
     * @return \Illuminate\Http\JsonResponse
     */
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
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Veículo não encontrado.']);
    }
}
