@extends('salarySurvey.layouts.main')

@section('customHeader')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection

@section('customStyle')
    /* ====== Base / Theme ====== */
    :root{
    --bg: #0f1115;
    --card: #161922;
    --card-2: #1b2030;
    --text: #e8eaf0;
    --muted: #a9b0c0;
    --primary: #7c9aff; /* accent */
    --accent: #b388ff; /* gradient 1 */
    --accent-2:#ffb74d; /* gradient 2 */
    --ring: rgba(124,154,255,.35);
    }

    @media (prefers-color-scheme: light){
    :root{
    --bg: #f7f9ff;
    --card:#ffffff;
    --card-2:#f2f5ff;
    --text:#0f1222;
    --muted:#55607a;
    --ring: rgba(124,154,255,.5);
    }
    }

    html, body{
    height:100%;
    }
    body{
    font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    background:
    radial-gradient(1200px 800px at 10% -10%, rgba(124,154,255,.15), transparent 40%),
    radial-gradient(900px 700px at 110% 10%, rgba(179,136,255,.14), transparent 35%),
    linear-gradient(180deg, rgba(10,12,18,.6), rgba(10,12,18,0)),
    var(--bg);
    color: var(--text);
    }

    /* ====== Nice container breathing room ====== */
    .container{
    max-width: 1100px;
    }

    /* ====== Shared cards / enter animation ====== */
    .result-card, .searchBox{
    background: linear-gradient(180deg, var(--card), var(--card-2));
    border-radius: 18px;
    box-shadow: 0 12px 40px rgba(0,0,0,.35);
    border: 1px solid rgba(255,255,255,.04);
    overflow: hidden;
    }

    /* subtle “lift” on hover for small cards */
    .job-card{
    background: linear-gradient(180deg, var(--card-2), var(--card));
    color: var(--text);
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    border: 1px solid transparent;
    }
    .job-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,.28);
    border-color: rgba(124,154,255,.25);
    }

    /* ====== Animated header sheen for the search box ====== */
    .searchBox{
    position: relative;
    isolation: isolate;
    }
    .searchBox::before{
    content:"";
    position:absolute; inset:-1px;
    background: linear-gradient(90deg, rgba(124,154,255,.15), rgba(179,136,255,.12), rgba(255,183,77,.10));
    background-size: 300% 100%;
    animation: sheen 18s linear infinite;
    z-index: -1;
    filter: blur(20px);
    opacity: .7;
    }
    @keyframes sheen{
    0%{ background-position: 0% 0; }
    50%{ background-position: 100% 0; }
    100%{ background-position: 0% 0; }
    }

    /* ====== Inputs ====== */
    .form-control{
    min-height: 52px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,.08);
    background-color: rgba(22, 25, 34, .9);
    color: var(--text);
    transition: box-shadow .2s ease, border-color .2s ease, background-color .2s ease;
    }
    .form-control::placeholder{ color: #aab2c5; }
    .form-control:focus{
    outline: none;
    border-color: var(--ring);
    box-shadow: 0 0 0 6px var(--ring);
    background-color: rgba(22, 25, 34, 1);
    }

    /* Buttons */
    .btn-light{
    font-weight: 700;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,.12);
    background: linear-gradient(180deg, #ffffff, #f1f4ff);
    color: #111;
    }
    .btn-light:hover{
    filter: brightness(.98);
    }
    .btn-primary, .btn-outline-light{
    border-radius: 12px;
    }

    /* Back link */
    .back-btn{
    margin-top: 16px;
    display: inline-flex; align-items:center; gap:.5rem;
    font-weight: 600;
    color: var(--text);
    text-decoration: none;
    background: rgba(255,255,255,.06);
    padding: 10px 14px;
    border-radius: 10px;
    transition: background .2s ease, transform .2s ease;
    }
    .back-btn:hover{
    background: rgba(255,255,255,.12);
    transform: translateY(-1px);
    }

    /* ====== Typography ====== */
    .mainSearchHeading{
    font-size: clamp(1.4rem, 3.6vw, 2.2rem);
    font-weight: 700;
    color: var(--text);
    text-align: center;
    letter-spacing: .3px;
    }

    .result-card h2{
    color: var(--text);
    font-weight: 800;
    letter-spacing: .2px;
    }
    .result-card h3{
    font-weight: 700;
    }

    /* Big gradient number */
    .average-pay{
    font-size: clamp(2.2rem, 5.5vw, 3.2rem);
    font-weight: 800;
    background: linear-gradient(90deg, var(--accent), var(--accent-2));
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    }

    /* ====== Chart container ====== */
    .chart-container{
    position: relative;
    width: 100%;
    height: clamp(240px, 48vw, 380px);
    margin-top: .5rem;
    }

    .job-title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%; /* prevents overflow issues */
    }


    /* ====== Responsive grid for top jobs ====== */
    @media (min-width: 768px){
    .top-jobs .col-md-4{ flex: 0 0 33.333%; max-width: 33.333%; }
    }
    @media (max-width: 767.98px){
    .top-jobs .col-md-4{ flex: 0 0 50%; max-width: 50%; }
    }
    @media (max-width: 480px){
    .top-jobs .col-md-4{ flex: 0 0 100%; max-width: 100%; }
    }

    /* ====== Motion safety ====== */
    @media (prefers-reduced-motion: reduce){
    * { animation: none !important; transition: none !important; }
    }

    /* ====== Subtle appear animation ====== */
    .fade-up{
    animation: fadeUp .5s ease both;
    }
    @keyframes fadeUp{
    from{ transform: translateY(12px); opacity:.0; }
    to{ transform: translateY(0); opacity:1; }
    }
@endsection


@section('mainBody')
    <div class="container mt-4">
        <!-- Search Form -->
        <div class="card searchBox mt-4 p-4 fade-up">
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
            <!-- babdge row to see the user typed query -->
            <div class="d-flex gap-2 flex-wrap mb-3">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2">Job: {{ $job }}</span>
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2">Location:
                    {{ $location }}</span>
            </div>
        </div>

        @if ($results == true)
            <!-- Salary Card -->
            <div class="card result-card mt-5 p-4 fade-up">
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
                <div class="card result-card mt-4 p-4 fade-up top-jobs">
                    <h3 class="mb-3">Top 5 Jobs Found</h3>
                    <div class="row">
                        @foreach ($topJobs as $item)
                            <div class="col-md-4 mb-3 d-flex">
                                <div class="card job-card p-3 h-100 w-100">
                                    <h5 class="mb-2 job-title" title="{{ $item['title'] }}">
                                        {{ $item['title'] }}
                                    </h5>
                                    <p class="mb-1 text-white">{{ $item['company'] }}</p>
                                    <a href="{{ $item['link'] }}" target="_blank"
                                        class="btn btn-outline-light btn-sm mt-auto">
                                        View Job
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <!-- Default Info Description -->
            <div class="card result-card mt-5 p-4 fade-up">
                <h2 class="mb-3">Welcome to the Salary Survey Tool</h2>
                <p style="color: white; font-size: 20px">Discover real-time salary insights for any job title, anywhere.
                </p>
                <p style="color: white">Simply enter a <b>Job Name</b> and <b>Location</b> to get
                    the lowest, average, and highest salary ranges—perfect for career planning, job switching, or salary
                    negotiation.</p>
            </div>
        @endif
    </div>

    @if ($results == true)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const canvas = document.getElementById('salaryChart');
                if (!canvas) return;

                // Pull dynamic values from Blade
                const LOW = {{ (int) ($lowest ?? 0) }};
                const AVG = {{ (int) ($average ?? 0) }};
                const HIGH = {{ (int) ($highest ?? 0) }};

                const ctx = canvas.getContext('2d');

                // pretty gradient
                const grad = ctx.createLinearGradient(0, 0, 0, canvas.height);
                grad.addColorStop(0, 'rgba(124,154,255,0.35)');
                grad.addColorStop(1, 'rgba(124,154,255,0.05)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Starting', 'Average', 'Highest'],
                        datasets: [{
                            data: [LOW, AVG, HIGH],
                            borderColor: '#7c9aff',
                            borderWidth: 2,
                            backgroundColor: grad,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: ['#ef5350', '#ffca28', '#66bb6a'],
                            pointBorderColor: ['#ef5350', '#ffca28', '#66bb6a'],
                            pointRadius: 5,
                            pointHoverRadius: 6,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 600,
                            easing: 'easeOutCubic'
                        },
                        layout: {
                            padding: {
                                top: 40,
                                bottom: 8,
                                left: 8,
                                right: 20
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(ctx) {
                                        const v = ctx.parsed.y || 0;
                                        return ' CAD ' + v.toLocaleString();
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                backgroundColor: 'rgba(0,0,0,.35)',
                                borderRadius: 6,
                                padding: 6,
                                font: {
                                    weight: 'bold',
                                    size: 12
                                },
                                formatter: function(value, context) {
                                    const labels = [
                                        "CAD {{ number_format($lowest ?? 0) }}",
                                        "CAD {{ number_format($average ?? 0) }}",
                                        "CAD {{ number_format($highest ?? 0) }}"
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
                                ticks: {
                                    callback: v => (v >= 1000 ? (v / 1000) + 'k' : v)
                                },
                                grid: {
                                    color: 'rgba(255,255,255,.06)'
                                },
                                border: {
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 13,
                                        weight: 700
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
