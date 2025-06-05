@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Novo Estacionamento</h1>

    <form action="{{ route('estacionamentos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome_localizacao" class="form-label">Localização</label>
            <input type="text" name="nome_localizacao" id="nome_localizacao" class="form-control" value="{{ old('nome_localizacao') }}" required>
        </div>

        <div class="mb-3">
            <label for="vagas_particulares" class="form-label">Vagas Particulares</label>
            <input type="number" name="vagas_particulares" id="vagas_particulares" class="form-control" min="0" value="{{ old('vagas_particulares', 0) }}" required>
        </div>

        <div class="mb-3">
            <label for="vagas_oficiais" class="form-label">Vagas Oficiais</label>
            <input type="number" name="vagas_oficiais" id="vagas_oficiais" class="form-control" min="0" value="{{ old('vagas_oficiais', 0) }}" required>
        </div>

        <div class="mb-3">
            <label for="vagas_motos" class="form-label">Vagas Motos</label>
            <input type="number" name="vagas_motos" id="vagas_motos" class="form-control" min="0" value="{{ old('vagas_motos', 0) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('estacionamentos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
