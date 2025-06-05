@extends('layouts.app')

@section('title', 'Cadastrar Veículo')

@section('content')
    <h1>Cadastrar Veículo</h1>

    <form action="{{ route('veiculos.store') }}" method="POST">
        @csrf

        @include('veiculos.form')

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

@section('scripts')
    @include('veiculos.form-scripts')
@endsection
