<?php

namespace App\Http\Controllers;

use App\Models\RegistroVeiculo;
use App\Models\Veiculo;
use App\Models\Motorista;
use App\Models\Usuario;
use Illuminate\Http\Request;

class RegistroVeiculoController extends Controller
{
    public function index()
    {
        $registros = RegistroVeiculo::with([
            'veiculo',
            'motoristaEntrada',
            'motoristaSaida',
            'usuarioLogado',
            'usuarioSaida'
        ])->paginate(10);

        return view('registro_veiculos.index', compact('registros'));
    }

    public function create()
    {
        $veiculos = Veiculo::all();

        // Motoristas sem filtro "ativo" para evitar erro
        $motoristas = Motorista::all();

        // Somente usuários ativos (tem coluna 'ativo')
        $usuarios = Usuario::where('ativo', true)->get();

        return view('registro_veiculos.create', compact('veiculos', 'motoristas', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|exists:veiculos,placa',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'cor' => 'required|string|max:20',
            'tipo' => 'required|in:OFICIAL,PARTICULAR,MOTO',
            'motorista_entrada_id' => 'required|exists:motoristas_oficiais,id',
            'horario_entrada' => 'required|date',
            'usuario_logado_id' => 'required|exists:usuarios,id',
            'localizacao' => 'required|string|max:50',
        ]);

        RegistroVeiculo::create($request->all());

        return redirect()->route('registro_veiculos.index')->with('success', 'Registro criado com sucesso.');
    }

    public function show($id)
    {
        $registro = RegistroVeiculo::with([
            'veiculo',
            'motoristaEntrada',
            'motoristaSaida',
            'usuarioLogado',
            'usuarioSaida'
        ])->findOrFail($id);

        return view('registro_veiculos.show', compact('registro'));
    }

    public function edit($id)
    {
        $registro = RegistroVeiculo::findOrFail($id);
        $veiculos = Veiculo::all();

        // Motoristas sem filtro "ativo"
        $motoristas = Motorista::all();

        // Somente usuários ativos
        $usuarios = Usuario::where('ativo', true)->get();

        return view('registro_veiculos.edit', compact('registro', 'veiculos', 'motoristas', 'usuarios'));
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
            'horario_entrada' => 'required|date',
            'motorista_saida_id' => 'nullable|exists:motoristas_oficiais,id',
            'horario_saida' => 'nullable|date',
            'usuario_logado_id' => 'required|exists:usuarios,id',
            'usuario_saida_id' => 'nullable|exists:usuarios,id',
            'localizacao' => 'required|string|max:50',
        ]);

        $registro->update($request->all());

        return redirect()->route('registro_veiculos.index')->with('success', 'Registro atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $registro = RegistroVeiculo::findOrFail($id);
        $registro->delete();

        return redirect()->route('registro_veiculos.index')->with('success', 'Registro deletado com sucesso.');
    }
}
