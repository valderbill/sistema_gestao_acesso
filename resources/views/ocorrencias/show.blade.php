@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Ocorrência #{{ $ocorrencia->id }}</h1>

    <p><strong>Placa:</strong> {{ $ocorrencia->placa }}</p>
    <p><strong>Ocorrência:</strong> {{ $ocorrencia->ocorrencia }}</p>
    <p><strong>Horário:</strong> {{ $ocorrencia->horario }}</p>
    <p><strong>Usuário:</strong> {{ $ocorrencia->usuario->nome ?? '' }}</p>

    <a href="{{ route('ocorrencias.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
