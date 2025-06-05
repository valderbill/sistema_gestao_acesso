<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $table = 'vagas';

    protected $fillable = [
        'vagas_particulares',
        'vagas_oficiais',
        'vagas_motos',
        'localizacao_id', // mantido para relacionamento
    ];

    // Desabilita timestamps porque a tabela não possui created_at e updated_at
    public $timestamps = false;

    /**
     * Relacionamento: vaga pertence a uma localização
     */
    public function localizacao()
    {
        return $this->belongsTo(Localizacao::class);
    }
}
