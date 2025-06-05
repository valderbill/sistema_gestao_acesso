@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Vaga</h1>

    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Localização:</strong> {{ $vaga->localizacao ? $vaga->localizacao->nome : 'Não informado' }}</p>
            <p class="card-text"><strong>Vagas Particulares:</strong> {{ $vaga->vagas_particulares }}</p>
            <p class="card-text"><strong>Vagas Oficiais:</strong> {{ $vaga->vagas_oficiais }}</p>
            <p class="card-text"><strong>Vagas Motos:</strong> {{ $vaga->vagas_motos }}</p>
            <a href="{{ route('vagas.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</div>
@endsection
