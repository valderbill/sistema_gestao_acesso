@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Registro de Veículo</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('registro_veiculos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <select name="placa" id="placa" class="form-select" required>
                <option value="">Selecione um veículo</option>
                @foreach($veiculos as $veiculo)
                    <option value="{{ $veiculo->placa }}" {{ old('placa') == $veiculo->placa ? 'selected' : '' }}>
                        {{ $veiculo->placa }} - {{ $veiculo->modelo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca') }}" required maxlength="50">
        </div>

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo') }}" required maxlength="50">
        </div>

        <div class="mb-3">
            <label for="cor" class="form-label">Cor</label>
            <input type="text" name="cor" id="cor" class="form-control" value="{{ old('cor') }}" required maxlength="20">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="">Selecione o tipo</option>
                <option value="OFICIAL" {{ old('tipo') == 'OFICIAL' ? 'selected' : '' }}>Oficial</option>
                <option value="PARTICULAR" {{ old('tipo') == 'PARTICULAR' ? 'selected' : '' }}>Particular</option>
                <option value="MOTO" {{ old('tipo') == 'MOTO' ? 'selected' : '' }}>Moto</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="motorista_entrada_id" class="form-label">Motorista Entrada</label>
            <select name="motorista_entrada_id" id="motorista_entrada_id" class="form-select" required>
                <option value="">Selecione motorista</option>
                @foreach($motoristas as $motorista)
                    <option value="{{ $motorista->id }}" {{ old('motorista_entrada_id') == $motorista->id ? 'selected' : '' }}>
                        {{ $motorista->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="motorista_saida_id" class="form-label">Motorista Saída (opcional)</label>
            <select name="motorista_saida_id" id="motorista_saida_id" class="form-select">
                <option value="">Nenhum</option>
                @foreach($motoristas as $motorista)
                    <option value="{{ $motorista->id }}" {{ old('motorista_saida_id') == $motorista->id ? 'selected' : '' }}>
                        {{ $motorista->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="horario_entrada" class="form-label">Horário Entrada</label>
            <input type="datetime-local" name="horario_entrada" id="horario_entrada" class="form-control" value="{{ old('horario_entrada') }}" required>
        </div>

        <div class="mb-3">
            <label for="horario_saida" class="form-label">Horário Saída (opcional)</label>
            <input type="datetime-local" name="horario_saida" id="horario_saida" class="form-control" value="{{ old('horario_saida') }}">
        </div>

        <div class="mb-3">
            <label for="usuario_logado_id" class="form-label">Usuário Entrada</label>
            <select name="usuario_logado_id" id="usuario_logado_id" class="form-select" required>
                <option value="">Selecione usuário</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ old('usuario_logado_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="usuario_saida_id" class="form-label">Usuário Saída (opcional)</label>
            <select name="usuario_saida_id" id="usuario_saida_id" class="form-select">
                <option value="">Nenhum</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ old('usuario_saida_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="localizacao" class="form-label">Localização</label>
            <input type="text" name="localizacao" id="localizacao" class="form-control" value="{{ old('localizacao') }}" required maxlength="50">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('registro_veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
