@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Novo Estacionamento</h1>

    <form action="{{ route('estacionamentos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="{{ old('endereco') }}" required>
        </div>

        <div class="mb-3">
            <label for="localizacao_id" class="form-label">Localização</label>
            <select name="localizacao_id" class="form-select" required>
                <option value="" disabled selected>Selecione uma localização</option>
                @foreach ($localizacoes as $localizacao)
                    <option value="{{ $localizacao->id }}" {{ old('localizacao_id') == $localizacao->id ? 'selected' : '' }}>
                        {{ $localizacao->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('estacionamentos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
