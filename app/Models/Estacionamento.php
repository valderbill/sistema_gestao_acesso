<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacionamento extends Model
{
    use HasFactory;

    // Se a tabela for diferente de 'estacionamentos', especifique aqui
    // protected $table = 'estacionamentos';

    // Campos que podem ser preenchidos via mass-assignment
    protected $fillable = [
        'nome',
        'endereco',
        'localizacao_id',
        'capacidade',
    ];

    // Relação com Localizacao (opcional, se quiser usar eager loading etc.)
    public function localizacao()
    {
        return $this->belongsTo(Localizacao::class);
    }
}
