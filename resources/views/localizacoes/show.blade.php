@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Localização</h1>

    <p><strong>ID:</strong> {{ $localizacao->id }}</p>
    <p><strong>Nome:</strong> {{ $localizacao->nome }}</p>
    <p><strong>Criado em:</strong> {{ $localizacao->created_at ? $localizacao->created_at->format('d/m/Y H:i') : 'Não informado' }}</p>
    <p><strong>Atualizado em:</strong> {{ $localizacao->updated_at ? $localizacao->updated_at->format('d/m/Y H:i') : 'Não informado' }}</p>

    <a href="{{ route('localizacoes.edit', $localizacao) }}">Editar</a> |
    <a href="{{ route('localizacoes.index') }}">Voltar</a>
</div>
@endsection
