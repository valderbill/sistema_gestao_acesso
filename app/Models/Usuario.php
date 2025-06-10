<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Nome da tabela no banco
    protected $table = 'usuarios';

    // Campos preenchíveis (mass assignable)
    protected $fillable = [
        'nome',
        'matricula',
        'senha',  // senha criptografada
        'perfil_id',
        'ativo',  // novo campo para status ativo/inativo
    ];

    // Campos ocultos em JSON
    protected $hidden = [
        'senha',
    ];

    // Relação com Perfil
    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }
}
