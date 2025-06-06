<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\AcessoLiberadoController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\RegistroVeiculoController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PermissaoController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\EstacionamentoController;

Route::get('/', function () {
    return view('welcome');
});

// Recursos principais
Route::resource('usuarios', UsuarioController::class);

// Nova rota para ativar/desativar usuário (toggle status)
Route::put('/usuarios/{usuario}/toggle-status', [UsuarioController::class, 'toggleStatus'])->name('usuarios.toggleStatus');

Route::resource('motoristas', MotoristaController::class);
Route::resource('acessos_liberados', AcessoLiberadoController::class);
Route::resource('veiculos', VeiculoController::class);
Route::resource('vagas', VagaController::class);
Route::resource('registro_veiculos', RegistroVeiculoController::class);
Route::resource('ocorrencias', OcorrenciaController::class);

// Perfis e permissões com parâmetros personalizados
Route::resource('perfis', PerfilController::class)->parameters([
    'perfis' => 'perfil'
]);
Route::resource('permissoes', PermissaoController::class)->parameters([
    'permissoes' => 'permissao'
]);

// Rota do painel
Route::get('/painel/dados', [PainelController::class, 'dados'])->name('painel.dados');

// Estacionamentos
Route::resource('estacionamentos', EstacionamentoController::class);

// Rota para buscar veículo por placa - Para preenchimento automático no formulário
Route::get('/veiculos/buscar-por-placa/{placa}', [VeiculoController::class, 'buscarPorPlaca'])->name('veiculos.buscarPorPlaca');
