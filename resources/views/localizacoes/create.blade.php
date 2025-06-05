@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Nova Localização</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('localizacoes.store') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" maxlength="100" required><br><br>

        <button type="submit">Salvar</button>
        <a href="{{ route('localizacoes.index') }}">Cancelar</a>
    </form>
</div>
@endsection
