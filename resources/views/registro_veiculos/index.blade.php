@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registros de Veículos</h1>
    <a href="{{ route('registro_veiculos.create') }}" class="btn btn-primary mb-3">Novo Registro</a>

    {{-- Painel de Contadores Digitais --}}
    <div class="mb-4">
        <h4>Painel de Vagas - Contadores Digitais</h4>

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

    {{-- Painel de Vagas com Gráfico --}}
    <div class="mb-4">
        <h4>Painel de Vagas</h4>
        <canvas id="graficoVagas" height="100"></canvas>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
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
                <th>Localização</th>
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
                    <td>{{ $registro->motoristaSaida->nome ?? 'N/A' }}</td>
                    <td>{{ $registro->horario_entrada }}</td>
                    <td>{{ $registro->horario_saida ?? 'N/A' }}</td>
                    <td>{{ $registro->usuarioLogado->nome ?? 'N/A' }}</td>
                    <td>{{ $registro->usuarioSaida->nome ?? 'N/A' }}</td>
                    <td>{{ $registro->localizacao }}</td>
                    <td>
                        <a href="{{ route('registro_veiculos.show', $registro->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('registro_veiculos.edit', $registro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('registro_veiculos.destroy', $registro->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $registros->links() }}
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Código do gráfico existente
    let ctx = document.getElementById('graficoVagas').getContext('2d');
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
        } else {
            chart = new Chart(ctx, config);
        }
    }

    // Novo código para atualizar os contadores digitais
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
        setInterval(atualizarDados, 10000); // Atualiza a cada 10 segundos
    });
</script>
@endsection
