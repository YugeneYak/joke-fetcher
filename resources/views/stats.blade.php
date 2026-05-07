@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Статистика посещений</h1>

        <div class="row mt-4">
            <div class="col-md-8">
                <canvas id="hourlyChart" width="800" height="400"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="cityChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const hourlyData = @json($hourlyStats);
        const cityData = @json($cityStats);

        new Chart(document.getElementById('hourlyChart'), {
            type: 'bar',
            data: {
                labels: hourlyData.map(h => h.hour),
                datasets: [{
                    label: 'Уникальные посетители',
                    data: hourlyData.map(h => h.unique_visitors),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: { title: { display: true, text: 'Час' } },
                    y: { title: { display: true, text: 'Количество' }, beginAtZero: true }
                }
            }
        });

        new Chart(document.getElementById('cityChart'), {
            type: 'pie',
            data: {
                labels: cityData.map(c => c.city),
                datasets: [{
                    data: cityData.map(c => c.total),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                }]
            }
        });
    </script>
@endsection
