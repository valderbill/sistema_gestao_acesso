<<<<<<< HEAD
@extends('layouts.app')

@section('content')
=======
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script>
        function alterarStatus(formId) {
            document.getElementById(formId).submit();
        }
    </script>
    <style>
        /* Força largura mínima nas colunas menores para melhor visual */
        .w-10 { width: 10%; }
        .w-15 { width: 15%; }
        /* Nome ocupará o restante do espaço */
    </style>
</head>
<body>
>>>>>>> 4718903 (10/06 correções)
<div class="container mt-5">
    <h1>Lista de Usuários</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">Cadastrar Novo</a>

<<<<<<< HEAD
    {{-- Exibir mensagem de sucesso geral --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Exibir nova senha para o usuário resetado --}}
    @if(session('novaSenha') && session('usuarioId'))
        <div class="alert alert-info">
            Senha redefinida para o usuário
            <strong>
                {{ $usuarios->firstWhere('id', session('usuarioId'))->nome ?? 'Usuário' }}
            </strong>:
            <code>{{ session('novaSenha') }}</code>
        </div>
    @endif

    <table class="table table-bordered" style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 35%;">Nome</th> <!-- maior espaço -->
                <th style="width: 15%; padding: 0.3rem;">Matrícula</th>
                <th style="width: 15%; padding: 0.3rem;">Perfil</th>
                <th style="width: 20%; padding: 0.3rem;">Ações</th>
                <th style="width: 15%; padding: 0.3rem;">Status</th>
=======
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Nome</th> <!-- sem largura fixa -->
                <th class="w-15">Matrícula</th>
                <th class="w-15">Perfil</th>
                <th class="w-15">Ações</th>
                <th class="w-10">Status</th>
>>>>>>> 4718903 (10/06 correções)
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
<<<<<<< HEAD
                    <td style="padding: 0.5rem;">{{ $usuario->nome }}</td>
                    <td style="padding: 0.3rem; white-space: nowrap;">{{ $usuario->matricula }}</td>
                    <td style="padding: 0.3rem; white-space: nowrap;">{{ $usuario->perfil->nome ?? 'N/A' }}</td>
                    <td style="padding: 0.3rem; white-space: nowrap;">
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm px-2 py-1">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm px-2 py-1">Editar</a>
                        <form action="{{ route('usuarios.resetSenha', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            {{-- REMOVIDO @method('PUT') para usar POST, pois a rota aceita somente POST --}}
                            <button type="submit" class="btn btn-secondary btn-sm px-2 py-1" onclick="return confirm('Tem certeza que deseja redefinir a senha para a matrícula?')">
                                Resetar Senha
                            </button>
=======
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->matricula }}</td>
                    <td>{{ $usuario->perfil->nome ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                    <td>
                        <form id="status-form-{{ $usuario->id }}" action="{{ route('usuarios.alternar-status', $usuario->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ativo" id="ativo-{{ $usuario->id }}" value="1"
                                       onchange="alterarStatus('status-form-{{ $usuario->id }}')" {{ $usuario->ativo ? 'checked' : '' }}>
                                <label class="form-check-label" for="ativo-{{ $usuario->id }}">Ativo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ativo" id="inativo-{{ $usuario->id }}" value="0"
                                       onchange="alterarStatus('status-form-{{ $usuario->id }}')" {{ !$usuario->ativo ? 'checked' : '' }}>
                                <label class="form-check-label" for="inativo-{{ $usuario->id }}">Inativo</label>
                            </div>
>>>>>>> 4718903 (10/06 correções)
                        </form>
                    </td>
                    <td style="padding: 0.3rem; white-space: nowrap;">
                        <form action="{{ route('usuarios.toggleStatus', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <div class="form-check form-check-inline" style="margin-bottom: 0;">
                                <input class="form-check-input" type="radio" name="ativo" value="1"
                                    onchange="this.form.submit()" {{ $usuario->ativo ? 'checked' : '' }}>
                                <label class="form-check-label" style="font-size: 0.85rem; margin-right: 0.5rem;">Ativo</label>
                            </div>
                            <div class="form-check form-check-inline" style="margin-bottom: 0;">
                                <input class="form-check-input" type="radio" name="ativo" value="0"
                                    onchange="this.form.submit()" {{ !$usuario->ativo ? 'checked' : '' }}>
                                <label class="form-check-label" style="font-size: 0.85rem;">Inativo</label>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
