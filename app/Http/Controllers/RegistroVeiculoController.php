<?php

namespace App\Http\Controllers;

use App\Models\RegistroVeiculo;
use App\Models\Veiculo;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroVeiculoController extends Controller
{
    public function index()
    {
        $registros = RegistroVeiculo::with([
            'veiculo',
            'motoristaEntrada',
            'motoristaSaida',
<<<<<<< HEAD
            'usuarioLogado',
            'usuarioSaida'
=======
            // 'usuarioLogado',
            // 'usuarioSaida'   
>>>>>>> 4718903 (10/06 correções)
        ])->paginate(10);

        $motoristas = Motorista::all();

        return view('registro_veiculos.index', compact('registros', 'motoristas'));
    }

    public function create()
    {
        $veiculos = Veiculo::all();

        // Motoristas sem filtro "ativo" para evitar erro
        $motoristas = Motorista::all();
<<<<<<< HEAD

        // Somente usuários ativos (tem coluna 'ativo')
        $usuarios = Usuario::where('ativo', true)->get();
=======
>>>>>>> 4718903 (10/06 correções)

        return view('registro_veiculos.create', compact('veiculos', 'motoristas'));
    }

    public function store(Request $request)
    {
        // Verifica se já existe uma entrada aberta para a placa (horario_saida = null)
        $registroAberto = RegistroVeiculo::where('placa', $request->placa)
            ->whereNull('horario_saida')
            ->first();

        if ($registroAberto) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['placa' => 'Este veículo já possui uma entrada aberta. Registre a saída antes de uma nova entrada.']);
        }

        $request->validate([
            'placa' => 'required|exists:veiculos,placa',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'cor' => 'required|string|max:20',
            'tipo' => 'required|in:OFICIAL,PARTICULAR,MOTO',
            'motorista_entrada_id' => 'required|exists:motoristas_oficiais,id',
            'motorista_saida_id' => 'nullable|exists:motoristas_oficiais,id',
            'horario_saida' => 'nullable|date',
            'usuario_saida_id' => 'nullable|exists:usuarios,id',
        ]);

        RegistroVeiculo::create(array_merge(
            $request->only([
                'placa',
                'marca',
                'modelo',
                'cor',
                'tipo',
                'motorista_entrada_id',
                'motorista_saida_id',
                'horario_saida',
                'usuario_saida_id',
            ]),
            ['horario_entrada' => now()] // define horário do sistema automaticamente
        ));

        return redirect()->route('registro_veiculos.index')->with('success', 'Registro criado com sucesso.');
    }

    public function show($id)
    {
        $registro = RegistroVeiculo::with([
            'veiculo',
            'motoristaEntrada',
            'motoristaSaida',
<<<<<<< HEAD
            'usuarioLogado',
            'usuarioSaida'
=======
            // 'usuarioLogado',
            // 'usuarioSaida'
>>>>>>> 4718903 (10/06 correções)
        ])->findOrFail($id);

        return view('registro_veiculos.show', compact('registro'));
    }

    public function edit($id)
    {
        $registro = RegistroVeiculo::findOrFail($id);
        $veiculos = Veiculo::all();

        // Motoristas sem filtro "ativo"
        $motoristas = Motorista::all();
<<<<<<< HEAD

        // Somente usuários ativos
        $usuarios = Usuario::where('ativo', true)->get();
=======
>>>>>>> 4718903 (10/06 correções)

        return view('registro_veiculos.edit', compact('registro', 'veiculos', 'motoristas'));
    }

    public function update(Request $request, $id)
    {
        $registro = RegistroVeiculo::findOrFail($id);

        $request->validate([
            'placa' => 'required|exists:veiculos,placa',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'cor' => 'required|string|max:20',
            'tipo' => 'required|in:OFICIAL,PARTICULAR,MOTO',
            'motorista_entrada_id' => 'required|exists:motoristas_oficiais,id',
            // Remove validação de 'horario_entrada' para manter original
            'motorista_saida_id' => 'nullable|exists:motoristas_oficiais,id',
            'horario_saida' => 'nullable|date',
            'usuario_saida_id' => 'nullable|exists:usuarios,id',
        ]);

        // Atualiza sem alterar o horário de entrada
        $registro->update($request->only([
            'placa',
            'marca',
            'modelo',
            'cor',
            'tipo',
            'motorista_entrada_id',
            'motorista_saida_id',
            'horario_saida',
            'usuario_saida_id',
        ]));

        return redirect()->route('registro_veiculos.index')->with('success', 'Registro atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $registro = RegistroVeiculo::findOrFail($id);
        $registro->delete();

        return redirect()->route('registro_veiculos.index')->with('success', 'Registro deletado com sucesso.');
    }

    public function buscarPorPlaca(Request $request)
    {
        $term = $request->input('term', '');

        $veiculos = Veiculo::where('placa', 'LIKE', '%' . $term . '%')
            ->limit(10)
            ->get();

        $results = $veiculos->map(function ($veiculo) {
            return [
                'id' => $veiculo->placa,
                'text' => $veiculo->placa . ' - ' . $veiculo->modelo,
                'marca' => $veiculo->marca,
                'modelo' => $veiculo->modelo,
                'cor' => $veiculo->cor,
                'tipo' => $veiculo->tipo,
            ];
        });

        return response()->json(['results' => $results]);
    }

    public function registrarSaida($id)
    {
        $registro = RegistroVeiculo::findOrFail($id);

        if ($registro->horario_saida !== null) {
            return redirect()->route('registro_veiculos.index')
                ->with('error', 'Saída já registrada para este veículo.');
        }

        $registro->horario_saida = now();
        $registro->usuario_saida_id = Auth::id();

        $registro->save();

        return redirect()->route('registro_veiculos.index')
            ->with('success', 'Saída registrada com sucesso!');
    }
}
