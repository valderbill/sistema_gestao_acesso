@extends('layouts.app')

@section('content')
    <h1>Detalhes do Veículo</h1>

    <ul>
        <li><strong>Placa:</strong> {{ $veiculo->placa }}</li>
        <li><strong>Modelo:</strong> {{ $veiculo->modelo }}</li>
        <li><strong>Cor:</strong> {{ $veiculo->cor }}</li>
        <li><strong>Tipo:</strong> {{ $veiculo->tipo }}</li>
        <li><strong>Marca:</strong> {{ $veiculo->marca }}</li>
        <li><strong>Acesso Liberado:</strong> {{ $veiculo->acesso->nome ?? 'N/A' }}</li>
    </ul>

    <a href="{{ route('veiculos.index') }}" class="btn btn-primary">Voltar</a>
@endsection
