@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Localização</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('localizacoes.update', $localizacao) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome', $localizacao->nome) }}" maxlength="100" required><br><br>

        <button type="submit">Atualizar</button>
        <a href="{{ route('localizacoes.index') }}">Cancelar</a>
    </form>
</div>
@endsection
