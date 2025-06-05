<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use App\Models\Localizacao;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    public function index()
    {
        $vagas = Vaga::with('localizacao')->get();  // já carrega localizacao para usar no index
        return view('vagas.index', compact('vagas'));
    }

    public function create()
    {
        $localizacoes = Localizacao::orderBy('nome')->get();
        return view('vagas.create', compact('localizacoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vagas_particulares' => 'required|integer|min:0',
            'vagas_oficiais' => 'required|integer|min:0',
            'vagas_motos' => 'required|integer|min:0',
            'localizacao_id' => 'required|exists:localizacoes,id',  // validação do campo FK
        ]);

        Vaga::create($request->all());

        return redirect()->route('vagas.index')->with('success', 'Vaga criada com sucesso.');
    }

    public function show(Vaga $vaga)
    {
        $vaga->load('localizacao'); // carregar relacionamento para mostrar detalhes
        return view('vagas.show', compact('vaga'));
    }

    public function edit(Vaga $vaga)
    {
        $localizacoes = Localizacao::orderBy('nome')->get();
        return view('vagas.edit', compact('vaga', 'localizacoes'));
    }

    public function update(Request $request, Vaga $vaga)
    {
        $request->validate([
            'vagas_particulares' => 'required|integer|min:0',
            'vagas_oficiais' => 'required|integer|min:0',
            'vagas_motos' => 'required|integer|min:0',
            'localizacao_id' => 'required|exists:localizacoes,id',  // validação no update
        ]);

        $vaga->update($request->all());

        return redirect()->route('vagas.index')->with('success', 'Vaga atualizada com sucesso.');
    }

    public function destroy(Vaga $vaga)
    {
        $vaga->delete();
        return redirect()->route('vagas.index')->with('success', 'Vaga removida com sucesso.');
    }
}
