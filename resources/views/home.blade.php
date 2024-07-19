@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                 
                    @endif
                    <canvas id="taskChart" width="400" height="200"></canvas>
                   
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Función para obtener los datos y crear el gráfico
    async function loadChart() {
        try {
            const response = await fetch('/task-status-counts');
            const data = await response.json();

            const ctx = document.getElementById('taskChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Puedes cambiar el tipo de gráfico si lo deseas
                data: {
                    labels: ['Pendiente', 'En Progreso', 'Completada'],
                    datasets: [{
                        label: 'Cantidad de Tareas',
                        data: [data['pendiente'], data['en progreso'], data['completada']],
                        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error al cargar los datos:', error);
        }
    }

    // Cargar el gráfico al cargar la página
    window.onload = loadChart;
</script>
@endsection
