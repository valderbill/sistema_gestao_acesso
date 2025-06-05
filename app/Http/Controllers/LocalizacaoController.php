<?php

namespace App\Http\Controllers;

use App\Models\Localizacao;
use Illuminate\Http\Request;

class LocalizacaoController extends Controller
{
    public function index()
    {
        $localizacoes = Localizacao::orderBy('nome')->paginate(10);
        return view('localizacoes.index', compact('localizacoes'));
    }

    public function create()
    {
        return view('localizacoes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|unique:localizacoes,nome|max:100',
        ]);

        Localizacao::create($request->only('nome'));

        return redirect()->route('localizacoes.index')
            ->with('success', 'Localização criada com sucesso.');
    }

    public function show(Localizacao $localizacao)
    {
        return view('localizacoes.show', compact('localizacao'));
    }

    public function edit(Localizacao $localizacao)
    {
        return view('localizacoes.edit', compact('localizacao'));
    }

    public function update(Request $request, Localizacao $localizacao)
    {
        $request->validate([
            'nome' => 'required|string|unique:localizacoes,nome,' . $localizacao->id . '|max:100',
        ]);

        $localizacao->update($request->only('nome'));

        return redirect()->route('localizacoes.index')
            ->with('success', 'Localização atualizada com sucesso.');
    }

    public function destroy(Localizacao $localizacao)
    {
        $localizacao->delete();

        return redirect()->route('localizacoes.index')
            ->with('success', 'Localização excluída com sucesso.');
    }
}
