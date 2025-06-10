@extends('layouts.app')

@section('content')
<div class="container">
    
    <a href="{{ route('registro_veiculos.create') }}" class="btn btn-primary mb-3">Novo Registro</a>

    {{-- Painel de Contadores Digitais --}}
    <div class="mb-4">
        <div style="display:flex; justify-content: space-around; text-align:center; font-family: monospace;">
            <div style="border:1px solid #ddd; padding:20px; border-radius:8px; width:200px;">
                <div style="font-size: 2.5rem; font-weight: bold;" id="total-oficial">0</div>
                <div>Total Oficiais</div>
                <div style="font-size: 1.8rem; color: green;" id="disponiveis-oficial">0</div>
                <div>Disponíveis</div>
            </div>
            <div style="border:1px solid #ddd; padding:20px; border-radius:8px; width:200px;">
                <div style="font-size: 2.5rem; font-weight: bold;" id="total-particular">0</div>
                <div>Total Particulares</div>
                <div style="font-size: 1.8rem; color: green;" id="disponiveis-particular">0</div>
                <div>Disponíveis</div>
            </div>
            <div style="border:1px solid #ddd; padding:20px; border-radius:8px; width:200px;">
                <div style="font-size: 2.5rem; font-weight: bold;" id="total-moto">0</div>
                <div>Total Motos</div>
                <div style="font-size: 1.8rem; color: green;" id="disponiveis-moto">0</div>
                <div>Disponíveis</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Tipo</th>
                <th>Motorista Entrada</th>
                <th>Motorista Saída</th>
                <th>Horário Entrada</th>
                <th>Horário Saída</th>
                <th>Usuário Entrada</th>
                <th>Usuário Saída</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
                <tr>
                    <td>{{ $registro->placa }}</td>
                    <td>{{ $registro->marca }}</td>
                    <td>{{ $registro->modelo }}</td>
                    <td>{{ $registro->cor }}</td>
                    <td>{{ $registro->tipo }}</td>
                    <td>{{ $registro->motoristaEntrada->nome ?? 'N/A' }}</td>
                    <td>
                        <form action="{{ route('registro_veiculos.registrar_saida', $registro->id) }}" method="POST" style="margin-bottom:0;">
                            @csrf
                            <select name="motorista_saida_id" class="form-control form-control-sm" required>
                                <option value="" disabled {{ !isset($registro->motoristaSaida) ? 'selected' : '' }}>Selecione motorista</option>
                                @foreach($motoristas as $motorista)
                                    <option value="{{ $motorista->id }}" 
                                        {{ (isset($registro->motoristaSaida) && $registro->motoristaSaida->id == $motorista->id) ? 'selected' : '' }}>
                                        {{ $motorista->nome }}
                                    </option>
                                @endforeach
                            </select>
                    </td>
                    <td>{{ $registro->horario_entrada }}</td>
                    <td>{{ $registro->horario_saida ?? 'N/A' }}</td>
                    <td>{{ $registro->usuarioLogado->nome ?? 'N/A' }}</td>
                    <td>{{ $registro->usuarioSaida->nome ?? 'N/A' }}</td>
                    <td>
                            <button type="submit" class="btn btn-success btn-sm mt-1"
                                onclick="return confirm('Confirmar registro de saída deste veículo?')"
                                @if($registro->horario_saida) disabled @endif>
                                Registrar Saída
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $registros->links() }}

    {{-- Canvas para gráfico (se desejar usar) --}}
    <canvas id="graficoVagas" style="max-width:600px; margin: 20px auto; display: block;"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let ctx = document.getElementById('graficoVagas')?.getContext('2d');
    let chart;

    function carregarGrafico(data) {
        const tipos = ['OFICIAL', 'PARTICULAR', 'MOTO'];
        const total = tipos.map(t => data.total[t] || 0);
        const ocupadas = tipos.map(t => data.ocupadas[t] || 0);
        const disponiveis = tipos.map((t, i) => total[i] - ocupadas[i]);

        const config = {
            type: 'bar',
            data: {
                labels: tipos,
                datasets: [
                    {
                        label: 'Total de Vagas',
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        data: total
                    },
                    {
                        label: 'Ocupadas',
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        data: ocupadas
                    },
                    {
                        label: 'Disponíveis',
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        data: disponiveis
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        };

        if (chart) {
            chart.data = config.data;
            chart.update();
        } else if(ctx) {
            chart = new Chart(ctx, config);
        }
    }

    function atualizarContadores(data) {
        ['oficial', 'particular', 'moto'].forEach(tipo => {
            const tipoMaiusculo = tipo.toUpperCase();
            const total = data.total[tipoMaiusculo] || 0;
            const ocupadas = data.ocupadas[tipoMaiusculo] || 0;
            const disponiveis = total - ocupadas;

            document.getElementById(`total-${tipo}`).textContent = total;
            document.getElementById(`disponiveis-${tipo}`).textContent = disponiveis;
        });
    }

    function atualizarDados() {
        fetch('{{ route('painel.dados') }}')
            .then(response => response.json())
            .then(data => {
                carregarGrafico(data);
                atualizarContadores(data);
            })
            .catch(err => console.error('Erro ao carregar dados:', err));
    }

    document.addEventListener('DOMContentLoaded', () => {
        atualizarDados();
        setInterval(atualizarDados, 10000);
    });
</script>
@endsection
