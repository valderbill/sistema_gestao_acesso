<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/redirect', function () {
    $perfil = Auth::user()->perfil;

    return match ($perfil) {
        'administrador' => redirect()->route('admin.dashboard'),
        'vigilante' => redirect()->route('vigilante.dashboard'),
        'recepcionista' => redirect()->route('recepcionista.dashboard'),
        default => redirect()->route('home'),
    };
})->middleware(['auth'])->name('perfil.redirect');

Route::middleware(['auth'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/vigilante/dashboard', 'vigilante.dashboard')->name('vigilante.dashboard');
    Route::view('/recepcionista/dashboard', 'recepcionista.dashboard')->name('recepcionista.dashboard');
    Route::view('/home', 'home')->name('home');
});
=======
// Recursos principais
Route::resource('usuarios', UsuarioController::class);

// Rota para buscar veículo por placa (preenchimento automático após seleção)
Route::get('/veiculos/buscar-por-placa/{placa}', [VeiculoController::class, 'buscarPorPlaca'])->name('veiculos.buscarPorPlaca');

// Rota para autocomplete via AJAX
Route::get('/veiculos/buscar', [RegistroVeiculoController::class, 'buscarPorPlaca'])->name('veiculos.buscar');

// Rota para alternar status do usuário (ativar/inativar)
Route::patch('usuarios/{usuario}/alternar-status', [UsuarioController::class, 'alternarStatus'])->name('usuarios.alternar-status');

Route::resource('motoristas', MotoristaController::class);
Route::resource('acessos_liberados', AcessoLiberadoController::class);
Route::resource('veiculos', VeiculoController::class);
Route::resource('vagas', VagaController::class);
Route::resource('registro_veiculos', RegistroVeiculoController::class);
Route::resource('ocorrencias', OcorrenciaController::class);

// PERFIL E PERMISSÕES
Route::resource('perfis', PerfilController::class)->parameters([
    'perfis' => 'perfil'
]);
Route::resource('permissoes', PermissaoController::class)->parameters([
    'permissoes' => 'permissao'
]);

// ROTA PARA REGISTRAR SAÍDA DE VEÍCULO (adicionada)
Route::post('registro_veiculos/{id}/registrar_saida', [RegistroVeiculoController::class, 'registrarSaida'])->name('registro_veiculos.registrar_saida');

// Rota do painel
Route::get('/painel/dados', [PainelController::class, 'dados'])->name('painel.dados');

// Estacionamentos
Route::resource('estacionamentos', EstacionamentoController::class);
>>>>>>> 4718903 (10/06 correções)
