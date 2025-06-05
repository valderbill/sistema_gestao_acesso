<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Detalhes do Usuário</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $usuario->nome }}</h5>
            <p class="card-text"><strong>Matrícula:</strong> {{ $usuario->matricula }}</p>
            <p class="card-text"><strong>Perfil:</strong> {{ $usuario->perfil->nome ?? 'N/A' }}</p>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </div>
    </div>
</div>
</body>
</html>
