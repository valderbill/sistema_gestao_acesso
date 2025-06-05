<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use App\Models\Localizacao;
use Illuminate\Http\Request;

class EstacionamentoController extends Controller
{
    public function index()
    {
        $estacionamentos = Estacionamento::with('localizacao')->get();
        return view('estacionamentos.index', compact('estacionamentos'));
    }

    public function create()
    {
        $localizacoes = Localizacao::all();
        return view('estacionamentos.create', compact('localizacoes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'localizacao_id' => 'required|exists:localizacoes,id',
        ]);

        Estacionamento::create($validated);

        return redirect()->route('estacionamentos.index')->with('success', 'Estacionamento criado com sucesso!');
    }

    public function show(Estacionamento $estacionamento)
    {
        $estacionamento->load('localizacao');
        return view('estacionamentos.show', compact('estacionamento'));
    }

    public function edit(Estacionamento $estacionamento)
    {
        $localizacoes = Localizacao::all();
        return view('estacionamentos.edit', compact('estacionamento', 'localizacoes'));
    }

    public function update(Request $request, Estacionamento $estacionamento)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'localizacao_id' => 'required|exists:localizacoes,id',
        ]);

        $estacionamento->update($validated);

        return redirect()->route('estacionamentos.index')->with('success', 'Estacionamento atualizado com sucesso!');
    }

    public function destroy(Estacionamento $estacionamento)
    {
        $estacionamento->delete();

        return redirect()->route('estacionamentos.index')->with('success', 'Estacionamento excluído com sucesso!');
    }
}
