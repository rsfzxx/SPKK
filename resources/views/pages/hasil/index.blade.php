<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Hasil Penilaian Karyawan</h1>
        <h2>Nilai Awal</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Absensi</th>
                    <th>Kerapihan</th>
                    <th>Loyalitas</th>
                    <th>Kinerja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->absensi }}</td>
                    <td>{{ $employee->kerapihan }}</td>
                    <td>{{ $employee->loyalitas }}</td>
                    <td>{{ $employee->kinerja }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Hasil Normalisasi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Normalisasi Absensi</th>
                    <th>Normalisasi Kerapihan</th>
                    <th>Normalisasi Loyalitas</th>
                    <th>Normalisasi Kinerja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->absensi_normalized }}</td>
                    <td>{{ $employee->kerapihan_normalized }}</td>
                    <td>{{ $employee->loyalitas_normalized }}</td>
                    <td>{{ $employee->kinerja_normalized }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="width: 500px; margin: auto;">
            <canvas id="averagePieChart"></canvas>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div style="width: 100%; height: 100%;">
                        <canvas id="top3Chart"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="width: 100%; height: 100%;">
                        <canvas id="top3Chart2"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div style="width: 100%; height: 100%;">
                        <canvas id="top3Chart3"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="width: 100%; height: 100%;">
                        <canvas id="top3Chart4"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <h2>Top 3 Karyawan</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Full Name</th>
                    <th>Total Nilai Normalisasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($top3Employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->total_normalized_score }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <div style="width: 800px; margin: auto;">
                    <canvas id="combinedBarChart"></canvas>
                </div>
            </div>
        </div>
        
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('averagePieChart').getContext('2d');
    var averagePieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Absensi', 'Loyalitas', 'Kerapihan', 'Kinerja'],
            datasets: [{
                label: 'Nilai Rata-Rata',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 252, 38, 0.5)',
                    'rgba(72, 245, 39, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 252, 38, 1)',
                    'rgba(72, 245, 39, 1)'
                ],
                borderWidth: 1,
                data: [
                    {{ $avgAbsensi }},
                    {{ $avgLoyalitas }},
                    {{ $avgKerapihan }},
                    {{ $avgKinerja }}
                ]
            }]
        },
        options: {
            // Atur opsi chart di sini
        }
    });
</script>


<script>
    var ctx = document.getElementById('combinedBarChart').getContext('2d');
        var combinedBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($top3Employees as $index => $employee)
                    '#{{ $loop->iteration }} - {{ $employee->full_name }}',
                @endforeach
            ],
            datasets: [
                {
                    label: 'Karyawan Terbaik',
                    backgroundColor: [
                        'rgba(0, 244, 241, 0.5)',
                        'rgba(185, 0, 244, 0.5)',
                        'rgba(255, 199, 0, 0.5)',
                    ],
                    borderColor: [
                        'rgba(0, 244, 241, 1)',
                        'rgba(185, 0, 244, 1)',
                        'rgba(255, 199, 0, 1)',
                    ],
                    borderWidth: 1,
                    data: [
                        @foreach($top3Employees as $employee)
                            {{ $employee->total_normalized_score }},
                        @endforeach
                    ]
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    stacked: true,
                    ticks: {
                        autoSkip: false
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('top3Chart').getContext('2d');
    var top3Chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($top3Absensi as $employee)
                    '{{ $employee->full_name }}',
                @endforeach
            ],
            datasets: [{
                label: 'Absensi',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: [
                    @foreach($top3Absensi as $employee)
                        {{ $employee->absensi }},
                    @endforeach
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx2 = document.getElementById('top3Chart2').getContext('2d');
    var top3Chart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [
                @foreach($top3Kerapihan as $employee)
                    '{{ $employee->full_name }}',
                @endforeach
            ],
            datasets: [{
                label: 'Kerapihan',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: [
                    @foreach($top3Kerapihan as $employee)
                        {{ $employee->kerapihan }},
                    @endforeach
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx3 = document.getElementById('top3Chart3').getContext('2d');
    var top3Chart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: [
                @foreach($top3Loyalitas as $employee)
                    '{{ $employee->full_name }}',
                @endforeach
            ],
            datasets: [{
                label: 'Loyalitas',
                backgroundColor: 'rgba(255, 252, 38, 0.5)',
                borderColor: 'rgba(255, 252, 38, 1)',
                borderWidth: 1,
                data: [
                    @foreach($top3Loyalitas as $employee)
                        {{ $employee->loyalitas }},
                    @endforeach
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx4 = document.getElementById('top3Chart4').getContext('2d');
    var top3Chart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: [
                @foreach($top3Kinerja as $employee)
                    '{{ $employee->full_name }}',
                @endforeach
            ],
            datasets: [{
                label: 'Kinerja',
                backgroundColor: 'rgba(72, 245, 39, 0.5)',
                borderColor: 'rgba(72, 245, 39, 1)',
                borderWidth: 1,
                data: [
                    @foreach($top3Kinerja as $employee)
                        {{ $employee->kinerja }},
                    @endforeach
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
</html>
