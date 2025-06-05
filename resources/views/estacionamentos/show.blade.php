@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalhes do Estacionamento</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $estacionamento->id }}
    </div>
    <div class="mb-3">
        <strong>Nome:</strong> {{ $estacionamento->nome }}
    </div>
    <div class="mb-3">
        <strong>Endereço:</strong> {{ $estacionamento->endereco }}
    </div>
    <div class="mb-3">
        <strong>Localização:</strong> {{ $estacionamento->localizacao->nome ?? 'Não informada' }}
    </div>

    <a href="{{ route('estacionamentos.index') }}" class="btn btn-secondary">Voltar</a>
    <a href="{{ route('estacionamentos.edit', $estacionamento->id) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
