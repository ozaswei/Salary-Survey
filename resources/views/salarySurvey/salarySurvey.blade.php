@extends('salarySurvey.layouts.main')

@section('customHeader')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection

@section('customStyle')
    body {
    font-family: 'Poppins', sans-serif;
    background: #121212;
    color: #f1f1f1;
    min-height: 100vh;
    }

    :root {
    --gradient-colors: linear-gradient(90deg, #333, #555, #777, #555, #333);
    }

    .searchBox {
    background: var(--gradient-colors);
    background-size: 600% 100%;
    animation: gradientSlide 15s linear infinite;
    border-radius: 1rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    @keyframes gradientSlide {
    0% {
    background-position: 0 0;
    }

    50% {
    background-position: 100% 0;
    }

    100% {
    background-position: 0 0;
    }
    }

    .mainSearchHeading {
    font-size: clamp(1.5rem, 4vw, 2.3rem);
    font-weight: 600;
    color: #fff;
    text-align: center;
    }

    .form-control {
    min-height: 52px;
    border-radius: .75rem;
    border: none;
    background-color: #222;
    color: #fff;
    }

    .form-control:focus {
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
    outline: none;
    }

    .btn-success {
    font-weight: bold;
    }

    .back-btn {
    margin-top: 20px;
    display: inline-block;
    font-weight: 600;
    color: #f1f1f1;
    text-decoration: none;
    background: #444;
    padding: 10px 16px;
    border-radius: 8px;
    transition: 0.3s;
    }

    .back-btn:hover {
    background: #6c757d;
    color: #fff;
    }

    .result-card {
    background: #1e1e1e;
    border-radius: 1.25rem;
    box-shadow: 0 12px 32px rgba(0, 0, 0, .5);
    }

    .result-card h2 {
    color: white;
    font-weight: 700;
    }

    .average-pay {
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(90deg, #b388ff, #ffb74d);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    }

    .chart-container {
    position: relative;
    width: 100%;
    height: 360px;
    }

    @media (max-width: 576px) {
    .chart-container {
    height: 260px;
    }
    }

    .job-card {
    background-color: #2a2a2a;
    color: #f1f1f1;
    transition: transform .3s ease, box-shadow .3s ease;
    }

    .job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(255, 255, 255, .2);
    }
@endsection

@section('mainBody')
    <div class="container mt-4">
        <!-- Search Form -->
        <div class="card searchBox mt-4 p-4 animate__animated animate__fadeIn">
            <h2 class="mainSearchHeading mb-4">Salary Survey</h2>
            <form method="POST" action="{{ route('runScraper') }}">
                @csrf
                <div class="row g-2">
                    <div class="col-md-5 mb-2">
                        <input type="text" name="job" class="form-control" placeholder="Job title"
                            value="{{ old('job', $job ?? '') }}" required>
                    </div>
                    <div class="col-md-5 mb-2">
                        <input type="text" name="location" class="form-control" placeholder="Location"
                            value="{{ old('location', $location ?? '') }}" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-light w-100 h-100">Find</button>
                    </div>
                </div>
            </form>
        </div>

        @if ($results == true)
            <!-- Salary Card -->
            <div class="card result-card mt-5 p-4">
                <h2 class="mb-3">How much does a <span class="text-primary">{{ $job }}</span> earn in <span
                        class="text-primary">{{ $location }}</span>?</h2>
                <p>Between <strong>CAD {{ number_format($lowest) }}</strong> and <strong>CAD
                        {{ number_format($highest) }}</strong> annually.</p>
                <div class="average-pay mb-4">CAD {{ number_format($average) }} / Year</div>
                <div class="chart-container">
                    <canvas id="salaryChart"></canvas>
                </div>
            </div>

            <!-- Top Jobs Found -->
            @if (!empty($topJobs) && is_array($topJobs))
                <div class="card result-card mt-4 p-4">
                    <h3 class="mb-3">Top 5 Jobs Found</h3>
                    <div class="row">
                        @foreach ($topJobs as $item)
                            <div class="col-md-4 mb-3">
                                <div class="card job-card p-3">
                                    <h5 class="mb-2">{{ $item['title'] }}</h5>
                                    <p class="mb-1" style="color:white">{{ $item['company'] }}</p>
                                    <a href="{{ $item['link'] }}" target="_blank" class="btn btn-outline-light btn-sm">View
                                        Job</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <!-- Default Info Description -->
            <div class="card result-card mt-5 p-4 animate__animated animate__fadeInUp">
                <h2 class="mb-3">Welcome to the Salary Survey Tool</h2>
                <p style="color: white; font-size: 20px">Discover real-time salary insights for any job title, anywhere. </p>
                <p style="color: white">Simply enter a <b>Job Name</b> and <b>Location</b> to get
                    the lowest, average, and highest salary ranges—perfect for career planning, job switching, or salary
                    negotiation.</p>
            </div>
        @endif
    </div>

    @if ($results == true)
        <!-- Chart.js & Data Labels -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const canvas = document.getElementById('salaryChart');
                if (!canvas) return;

                new Chart(canvas.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['Starting', 'Average', 'Highest'],
                        datasets: [{
                            data: [30000, 50000, 110000],
                            borderColor: '#bb86fc',
                            borderWidth: 2,
                            backgroundColor: 'rgba(187, 134, 252, 0.2)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: ['#f44336', '#ffc107', '#4caf50'],
                            pointBorderColor: ['#f44336', '#ffc107', '#4caf50'],
                            pointRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                top: 60,
                                bottom: 10,
                                left: 10,
                                right: 30
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: function(value, context) {
                                    const labels = [
                                        "${{ number_format($lowest) }}",
                                        "${{ number_format($average) }}",
                                        "${{ number_format($highest) }}"
                                    ];
                                    return labels[context.dataIndex];
                                },
                                anchor: 'end',
                                align: 'top',
                                offset: 8,
                                clip: false
                            }
                        },
                        scales: {
                            y: {
                                display: false
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    }
                                },
                                border: {
                                    display: false
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            });
        </script>
    @endif
@endsection
