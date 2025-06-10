<div class="mb-3">
    <label for="placa" class="form-label">Placa</label>
    <input
        type="text"
        name="placa"
        id="placa"
        class="form-control"
        maxlength="7"
        autocomplete="off"
        value="{{ old('placa', $veiculo->placa ?? '') }}"
        required
        aria-describedby="placaHelp"
    >
</div>

<div class="mb-3">
    <label for="modelo" class="form-label">Modelo</label>
    <input
        type="text"
        name="modelo"
        id="modelo"
        class="form-control"
        value="{{ old('modelo', $veiculo->modelo ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="cor" class="form-label">Cor</label>
    <input
        type="text"
        name="cor"
        id="cor"
        class="form-control"
        value="{{ old('cor', $veiculo->cor ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <select name="tipo" id="tipo" class="form-select" required>
        <option value="">Selecione...</option>
        <option value="OFICIAL" {{ old('tipo', $veiculo->tipo ?? '') == 'OFICIAL' ? 'selected' : '' }}>OFICIAL</option>
        <option value="PARTICULAR" {{ old('tipo', $veiculo->tipo ?? '') == 'PARTICULAR' ? 'selected' : '' }}>PARTICULAR</option>
        <option value="MOTO" {{ old('tipo', $veiculo->tipo ?? '') == 'MOTO' ? 'selected' : '' }}>MOTO</option>
    </select>
</div>

<div class="mb-3">
    <label for="marca" class="form-label">Marca</label>
    <input
        type="text"
        name="marca"
        id="marca"
        class="form-control"
        value="{{ old('marca', $veiculo->marca ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="acesso_id" class="form-label">Acesso Liberado</label>
    <select name="acesso_id" id="acesso_id" class="form-select">
        <option value="">Selecione...</option>
        @foreach($acessos as $acesso)
            <option value="{{ $acesso->id }}" {{ old('acesso_id', $veiculo->acesso_id ?? '') == $acesso->id ? 'selected' : '' }}>
                {{ $acesso->nome }} - {{ $acesso->matricula }}
            </option>
        @endforeach
    </select>
</div>

{{-- Select de usuários ativos para entrada --}}
<div class="mb-3">
    <label for="usuario_logado_id" class="form-label">Usuário Entrada</label>
    <select name="usuario_logado_id" id="usuario_logado_id" class="form-select" required>
        <option value="">Selecione usuário</option>
        @foreach($usuarios as $usuario)
            @if($usuario->ativo)
                <option value="{{ $usuario->id }}" {{ old('usuario_logado_id', $veiculo->usuario_logado_id ?? '') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nome }}
                </option>
            @endif
        @endforeach
    </select>
</div>

{{-- Select de usuários ativos para saída --}}
<div class="mb-3">
    <label for="usuario_saida_id" class="form-label">Usuário Saída (opcional)</label>
    <select name="usuario_saida_id" id="usuario_saida_id" class="form-select">
        <option value="">Nenhum</option>
        @foreach($usuarios as $usuario)
            @if($usuario->ativo)
                <option value="{{ $usuario->id }}" {{ old('usuario_saida_id', $veiculo->usuario_saida_id ?? '') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nome }}
                </option>
            @endif
        @endforeach
    </select>
</div>
