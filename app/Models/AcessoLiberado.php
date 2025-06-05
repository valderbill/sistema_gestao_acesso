<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AcessoLiberado extends Model
{
    // Habilita os timestamps automáticos
    public $timestamps = true;

    // Nome da tabela correta no banco
    protected $table = 'acessos_liberados';

    // Campos permitidos para inserção em massa
    protected $fillable = [
        'nome',
        'matricula',
        'localizacao',
    ];

    // Define os campos de data como objetos Carbon
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
