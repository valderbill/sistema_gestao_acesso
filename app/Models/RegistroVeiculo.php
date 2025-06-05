<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroVeiculo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'cor',
        'tipo',
        'motorista_entrada_id',
        'motorista_saida_id',
        'horario_entrada',
        'horario_saida',
        'usuario_logado_id',
        'usuario_saida_id',
        'localizacao',
    ];

    // relações (exemplo)
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'placa', 'placa');
    }

    public function motoristaEntrada()
    {
        return $this->belongsTo(Motorista::class, 'motorista_entrada_id');
    }

    public function motoristaSaida()
    {
        return $this->belongsTo(Motorista::class, 'motorista_saida_id');
    }

    public function usuarioLogado()
    {
        return $this->belongsTo(Usuario::class, 'usuario_logado_id');
    }

    public function usuarioSaida()
    {
        return $this->belongsTo(Usuario::class, 'usuario_saida_id');
    }
}
