<div class="mb-3">
    <label for="placa" class="form-label">Placa</label>
    <input type="text" name="placa" class="form-control" value="{{ old('placa', $veiculo->placa ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="modelo" class="form-label">Modelo</label>
    <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $veiculo->modelo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="cor" class="form-label">Cor</label>
    <input type="text" name="cor" class="form-control" value="{{ old('cor', $veiculo->cor ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <select name="tipo" class="form-select" required>
        <option value="OFICIAL" {{ old('tipo', $veiculo->tipo ?? '') == 'OFICIAL' ? 'selected' : '' }}>OFICIAL</option>
        <option value="PARTICULAR" {{ old('tipo', $veiculo->tipo ?? '') == 'PARTICULAR' ? 'selected' : '' }}>PARTICULAR</option>
        <option value="MOTO" {{ old('tipo', $veiculo->tipo ?? '') == 'MOTO' ? 'selected' : '' }}>MOTO</option>
    </select>
</div>

<div class="mb-3">
    <label for="marca" class="form-label">Marca</label>
    <input type="text" name="marca" class="form-control" value="{{ old('marca', $veiculo->marca ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="localizacao" class="form-label">Localização</label>
    <input type="text" name="localizacao" class="form-control" value="{{ old('localizacao', $veiculo->localizacao ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="nome" class="form-label">Nome (Opcional)</label>
    <input type="text" name="nome" class="form-control" value="{{ old('nome', $veiculo->nome ?? '') }}">
</div>

<div class="mb-3">
    <label for="acesso_id" class="form-label">Acesso Liberado</label>
    <select name="acesso_id" class="form-select">
        <option value="">Selecione...</option>
        @foreach($acessos as $acesso)
            <option value="{{ $acesso->id }}" {{ old('acesso_id', $veiculo->acesso_id ?? '') == $acesso->id ? 'selected' : '' }}>
                {{ $acesso->nome }} - {{ $acesso->matricula }}
            </option>
        @endforeach
    </select>
</div>
