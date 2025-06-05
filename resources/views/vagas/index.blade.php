@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Vagas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('vagas.create') }}" class="btn btn-primary mb-3">Nova Vaga</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Localização</th>
                <th>Vagas Particulares</th>
                <th>Vagas Oficiais</th>
                <th>Vagas Motos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vagas as $vaga)
                <tr>
                    <td>{{ $vaga->localizacao ? $vaga->localizacao->nome : 'Não informado' }}</td>
                    <td>{{ $vaga->vagas_particulares }}</td>
                    <td>{{ $vaga->vagas_oficiais }}</td>
                    <td>{{ $vaga->vagas_motos }}</td>
                    <td>
                        <a href="{{ route('vagas.show', $vaga->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('vagas.edit', $vaga->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('vagas.destroy', $vaga->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza?')" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
