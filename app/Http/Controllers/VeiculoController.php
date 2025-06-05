<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\AcessoLiberado;
use Illuminate\Http\Request;
use App\Models\Motorista;


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
        return view('veiculos.create', compact('acessos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:10',
            'modelo' => 'required|string|max:100',
            'cor' => 'required|string|max:50',
            'tipo' => 'required|in:OFICIAL,PARTICULAR,MOTO',
            'marca' => 'required|string|max:50',
            'localizacao' => 'required|string|max:100',
            'nome' => 'nullable|string|max:100',
            'acesso_id' => 'nullable|exists:acessos_liberados,id',
        ]);

        Veiculo::create($request->all());

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso.');
    }

    public function show(Veiculo $veiculo)
    {
        return view('veiculos.show', compact('veiculo'));
    }

    public function edit(Veiculo $veiculo)
    {
        $acessos = AcessoLiberado::all();
        return view('veiculos.edit', compact('veiculo', 'acessos'));
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        $request->validate([
            'placa' => 'required|string|max:10',
            'modelo' => 'required|string|max:100',
            'cor' => 'required|string|max:50',
            'tipo' => 'required|in:OFICIAL,PARTICULAR,MOTO',
            'marca' => 'required|string|max:50',
            'localizacao' => 'required|string|max:100',
            'nome' => 'nullable|string|max:100',
            'acesso_id' => 'nullable|exists:acessos_liberados,id',
        ]);

        $veiculo->update($request->all());

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso.');
    }

    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();
        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso.');
    }
}
