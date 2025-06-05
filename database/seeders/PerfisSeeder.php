<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perfil; // Certifique-se que o model está correto

class PerfisSeeder extends Seeder
{
    public function run()
    {
        $perfis = ['administrador', 'recepcionista', 'vigilante', 'garçom'];

        foreach ($perfis as $nomePerfil) {
            Perfil::firstOrCreate(['nome' => $nomePerfil]);
        }
    }
}
