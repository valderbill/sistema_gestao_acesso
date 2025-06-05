@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Localizações</h1>

    @if (session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('localizacoes.create') }}">Nova Localização</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top:15px; width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($localizacoes as $localizacao)
                <tr>
                    <td>{{ $localizacao->id }}</td>
                    <td>{{ $localizacao->nome }}</td>
                    <td>
                        <a href="{{ route('localizacoes.show', $localizacao) }}">Ver</a> |
                        <a href="{{ route('localizacoes.edit', $localizacao) }}">Editar</a> |
                        <form action="{{ route('localizacoes.destroy', $localizacao) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirma exclusão?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">Nenhuma localização cadastrada.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $localizacoes->links() }}
</div>
@endsection
