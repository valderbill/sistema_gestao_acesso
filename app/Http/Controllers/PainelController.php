<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\RegistroVeiculo;

class PainelController extends Controller
{
    /**
     * Retorna os dados de vagas para o painel de controle.
     */
    public function dados()
    {
        // Pega o único registro da tabela vagas (assumindo que existe apenas um)
        $vaga = Vaga::first();

        $tipos = ['OFICIAL', 'PARTICULAR', 'MOTO'];

        // Mapeia tipo para nome da coluna correspondente no banco
        $colunasTotal = [
            'OFICIAL' => 'vagas_oficiais',
            'PARTICULAR' => 'vagas_particulares',
            'MOTO' => 'vagas_motos',
        ];

        $dados = [
            'total' => [],
            'ocupadas' => []
        ];

        foreach ($tipos as $tipo) {
            // Total de vagas vem da tabela vagas, lendo a coluna correta
            $total = $vaga ? $vaga->{$colunasTotal[$tipo]} : 0;

            // Contagem de veículos atualmente estacionados (sem horário_saida) do tipo
            $ocupadas = RegistroVeiculo::where('tipo', $tipo)
                ->whereNull('horario_saida')
                ->count();

            $dados['total'][$tipo] = $total;
            $dados['ocupadas'][$tipo] = $ocupadas;
        }

        return response()->json($dados);
    }
}
