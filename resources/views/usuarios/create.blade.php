<<<<<<< HEAD
@extends('layouts.app')

@section('content')
=======
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícone do raio (FontAwesome CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
>>>>>>> 4718903 (10/06 correções)
<div class="container mt-5">
    <h1>Cadastrar Usuário</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
<<<<<<< HEAD
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
=======
            <input type="text" class="form-control" id="nome" name="nome" required value="{{ old('nome') }}">
>>>>>>> 4718903 (10/06 correções)
        </div>

        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula</label>
<<<<<<< HEAD
            <input type="text" class="form-control" id="matricula" name="matricula" value="{{ old('matricula') }}" required>
=======
            <input type="text" class="form-control" id="matricula" name="matricula" required value="{{ old('matricula') }}">
>>>>>>> 4718903 (10/06 correções)
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <div class="mb-3">
            <label for="perfil_id" class="form-label">Perfil</label>
            <select class="form-select" id="perfil_id" name="perfil_id" required>
                <option value="">Selecione um perfil</option>
                @foreach($perfis as $perfil)
                    <option value="{{ $perfil->id }}" {{ old('perfil_id') == $perfil->id ? 'selected' : '' }}>
                        {{ $perfil->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="ativo" name="ativo" {{ old('ativo', 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">
                <i class="fa-solid fa-bolt" style="color: #ffc107;"></i> Ativo
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
