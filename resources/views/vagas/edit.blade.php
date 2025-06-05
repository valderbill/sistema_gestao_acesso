@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Vaga</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vagas.update', $vaga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="localizacao_id" class="form-label">Localização</label>
            <select name="localizacao_id" id="localizacao_id" class="form-select" required>
                <option value="" disabled>Selecione a localização</option>
                @foreach ($localizacoes as $localizacao)
                    <option value="{{ $localizacao->id }}" 
                        {{ (old('localizacao_id', $vaga->localizacao_id) == $localizacao->id) ? 'selected' : '' }}>
                        {{ $localizacao->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="vagas_particulares" class="form-label">Vagas Particulares</label>
            <input type="number" name="vagas_particulares" class="form-control" id="vagas_particulares" value="{{ old('vagas_particulares', $vaga->vagas_particulares) }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="vagas_oficiais" class="form-label">Vagas Oficiais</label>
            <input type="number" name="vagas_oficiais" class="form-control" id="vagas_oficiais" value="{{ old('vagas_oficiais', $vaga->vagas_oficiais) }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="vagas_motos" class="form-label">Vagas Motos</label>
            <input type="number" name="vagas_motos" class="form-control" id="vagas_motos" value="{{ old('vagas_motos', $vaga->vagas_motos) }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('vagas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
