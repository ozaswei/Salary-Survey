@extends('salarySurvey.layouts.main')

@section('customHeader')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
@endsection

@section('customStyle')
    /* ===== Theme ===== */
    :root{
    --bg: #0b0f1a;
    --card: rgba(18,22,33,.72);
    --card-2: rgba(23,29,44,.82);
    --text: #eaf0ff;
    --muted:#98a4c5;
    --primary:#8bb3ff;
    --accent1:#a78bfa; /* purple */
    --accent2:#60a5fa; /* blue */
    --accent3:#f59e0b; /* amber */
    --ring: rgba(139,179,255,.38);
    }

    @media (prefers-color-scheme: light){
    :root{
    --bg: #f7f9ff;
    --card: rgba(255,255,255,.85);
    --card-2: rgba(246,248,255,.9);
    --text:#0f1326;
    --muted:#445070;
    --ring: rgba(96,165,250,.45);
    }
    }

    /* ===== Page base ===== */
    html,body{height:100%}
    body{
    font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    color: var(--text);
    background: var(--bg);
    }

    /* ===== Fixed Aurora background (GPU-cheap) ===== */
    .site-bg{position:fixed; inset:0; z-index:-1; pointer-events:none; overflow:hidden}
    .site-bg::before,
    .site-bg::after{
    content:""; position:absolute; width:90vmax; height:90vmax; filter: blur(60px);
    background:
    radial-gradient(35% 35% at 30% 40%, rgba(96,165,250,.38), transparent 60%),
    radial-gradient(30% 30% at 70% 60%, rgba(167,139,250,.38), transparent 60%),
    radial-gradient(25% 25% at 50% 20%, rgba(245,158,11,.22), transparent 60%);
    transform: translate3d(-10%, -10%, 0) rotate(10deg);
    animation: drift 22s ease-in-out infinite alternate;
    }
    .site-bg::after{
    transform: translate3d(10%, 0%, 0) rotate(-8deg) scale(1.1);
    animation-duration: 28s;
    mix-blend-mode: screen;
    }

    /* tiny noise overlay to add texture without an image file */
    .site-noise{
    position:fixed; inset:0; z-index:-1; pointer-events:none; opacity:.08;
    background-image: repeating-linear-gradient(0deg, rgba(255,255,255,.08) 0 1px, transparent 1px 2px),
    repeating-linear-gradient(90deg, rgba(255,255,255,.05) 0 1px, transparent 1px 2px);
    }

    /* Aurora motion */
    @keyframes drift{
    from{ transform: translate3d(-6%, -4%, 0) rotate(8deg) scale(1.05); }
    to { transform: translate3d(6%, 4%, 0) rotate(-8deg) scale(1.1); }
    }

    /* ===== Container & cards ===== */
    .container{ max-width: 1100px; }

    .result-card, .searchBox{
    background: linear-gradient(180deg, var(--card), var(--card-2));
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 12px 36px rgba(0,0,0,.35);
    overflow: hidden;
    content-visibility:auto; /* performance */
    }

    /* inputs */
    .form-control{
    min-height: 52px; border-radius:14px;
    border:1px solid rgba(255,255,255,.12);
    background: rgba(14,18,28,.85);
    color: var(--text);
    transition: border-color .18s ease, box-shadow .18s ease, background-color .18s ease;
    }
    .form-control::placeholder{ color:#9aa6c7 }
    .form-control:focus{
    outline: none; border-color: var(--ring);
    box-shadow: 0 0 0 6px var(--ring);
    background: rgba(14,18,28,1);
    }

    /* buttons */
    .btn-light{
    font-weight:700; border-radius:14px;
    border:1px solid rgba(255,255,255,.12);
    background: linear-gradient(180deg,#ffffff,#f1f4ff);
    color:#111;
    }
    .btn-light:hover{ filter:brightness(.98) }
    .btn-primary, .btn-outline-light{ border-radius:12px }

    /* titles */
    .mainSearchHeading{ font-size: clamp(1.4rem, 3.6vw, 2.2rem); font-weight:800; letter-spacing:.2px; }
    .result-card h2{ font-weight:800; letter-spacing:.2px }
    .result-card h3{ font-weight:700 }

    /* highlight number */
    .average-pay{
    font-size: clamp(2.2rem, 5.5vw, 3.2rem);
    font-weight: 800;
    background: linear-gradient(90deg, var(--accent1), var(--accent2), var(--accent3));
    -webkit-background-clip:text; background-clip:text; -webkit-text-fill-color:transparent;
    }

    /* chart box */
    .chart-container{ position:relative; width:100%; height:clamp(240px, 48vw, 380px); margin-top:.5rem }

    /* job cards */
    .job-card{
    background: linear-gradient(180deg, var(--card-2), var(--card));
    color: var(--text);
    transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    border:1px solid rgba(255,255,255,.06);
    display:flex; flex-direction:column;
    }
    .job-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,.28);
    border-color: rgba(139,179,255,.28);
    }

    /* equalize heights + ellipsis */
    .job-title{
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:100%;
    }

    /* subtle “pop-in” */
    .fade-up{ animation: fadeUp .5s ease both }
    @keyframes fadeUp{
    from{ transform: translate3d(0,12px,0); opacity:0 }
    to{ transform: translate3d(0,0,0); opacity:1 }
    }

    /* responsive grid for Top Jobs */
    @media (min-width: 768px){ .top-jobs .col-md-4{ flex:0 0 33.333%; max-width:33.333% } }
    @media (max-width: 767.98px){ .top-jobs .col-md-4{ flex:0 0 50%; max-width:50% } }
    @media (max-width: 480px){ .top-jobs .col-md-4{ flex:0 0 100%; max-width:100% } }

    /* accessibility: reduce motion */
    @media (prefers-reduced-motion: reduce){
    *{ animation:none !important; transition:none !important }
    }

    .has-tip{ position:relative; cursor:help }
    .has-tip::after{
    content: attr(data-tip);
    position:absolute; left:0; bottom:100%; transform: translateY(-8px);
    max-width: 80vw; width: max-content; min-width: 180px;
    background: rgba(10,12,18,.92);
    color:#fff; border:1px solid rgba(255,255,255,.12);
    padding:10px 12px; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,.35);
    pointer-events:none; opacity:0; visibility:hidden; transition: opacity .15s ease, transform .15s ease;
    white-space:normal; /* allow wrap */
    z-index: 10;
    }
    .has-tip:hover::after{
    opacity:1; visibility:visible; transform: translateY(-12px);
    }
@endsection


@section('mainBody')
    <div class="site-bg" aria-hidden="true"></div>
    <div class="site-noise" aria-hidden="true"></div>
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
            @if (($job ?? '') !== '' || ($location ?? '') !== '')
                <div class="d-flex gap-2 flex-wrap mt-3">
                    @if (($job ?? '') !== '')
                        <span class="badge rounded-pill px-3 py-2"
                            style="background:rgba(96,165,250,.15); color:#cfe1ff; border:1px solid rgba(96,165,250,.25);">
                            Job: {{ $job }}
                        </span>
                    @endif
                    @if (($location ?? '') !== '')
                        <span class="badge rounded-pill px-3 py-2"
                            style="background:rgba(167,139,250,.15); color:#e6ddff; border:1px solid rgba(167,139,250,.25);">
                            Location: {{ $location }}
                        </span>
                    @endif
                </div>
            @endif

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
                                    <h5 class="mb-2 job-title has-tip" data-tip="{{ $item['title'] }}">
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
            (function() {
                // Avoid duplicate charts if this view re-renders via Turbolinks/Livewire/etc.
                let salaryChartInstance = null;
                let resizeHandler = null;

                function initSalaryChart() {
                    const canvas = document.getElementById('salaryChart');
                    if (!canvas) return;

                    // Dynamic values from Blade (fallback to 0)
                    const LOW = {{ (int) ($lowest ?? 0) }};
                    const AVG = {{ (int) ($average ?? 0) }};
                    const HIGH = {{ (int) ($highest ?? 0) }};

                    // If all are zero/empty, skip making a chart
                    if ((LOW || AVG || HIGH) === 0) return;

                    const ctx = canvas.getContext('2d');

                    // Create gradient that adapts to canvas size
                    function makeGradient() {
                        const g = ctx.createLinearGradient(0, 0, 0, canvas.height);
                        g.addColorStop(0, 'rgba(124,154,255,0.35)');
                        g.addColorStop(1, 'rgba(124,154,255,0.05)');
                        return g;
                    }

                    const dataPoints = [LOW, AVG, HIGH];
                    const labels = ['Starting', 'Average', 'Highest'];

                    // CAD formatter
                    const fmt = new Intl.NumberFormat('en-CA', {
                        maximumFractionDigits: 0
                    });

                    // Clean up previous instance
                    if (salaryChartInstance && typeof salaryChartInstance.destroy === 'function') {
                        salaryChartInstance.destroy();
                    }

                    // Build chart
                    salaryChartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [{
                                data: dataPoints,
                                borderColor: '#7c9aff',
                                borderWidth: 2,
                                backgroundColor: makeGradient(),
                                fill: true,
                                tension: 0.35,
                                pointBackgroundColor: ['#ef5350', '#ffca28', '#66bb6a'],
                                pointBorderColor: ['#ef5350', '#ffca28', '#66bb6a'],
                                pointRadius: 5,
                                pointHoverRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)')
                                    .matches) ?
                                false :
                                {
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
                                        label: (ctx) => ' CAD ' + fmt.format(ctx.parsed.y || 0)
                                    }
                                },
                                datalabels: {
                                    display: (ctx) => (ctx.dataset.data[ctx.dataIndex] || 0) > 0,
                                    color: '#fff',
                                    backgroundColor: 'rgba(0,0,0,.35)',
                                    borderRadius: 6,
                                    padding: 6,
                                    font: {
                                        weight: 'bold',
                                        size: 12
                                    },
                                    formatter: (_value, context) => {
                                        const pretty = [
                                            "CAD {{ number_format($lowest ?? 0) }}",
                                            "CAD {{ number_format($average ?? 0) }}",
                                            "CAD {{ number_format($highest ?? 0) }}"
                                        ];
                                        return pretty[context.dataIndex];
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
                                        callback: (v) => (v >= 1000 ? (v / 1000) + 'k' : v)
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
                        // Register plugin only if available
                        plugins: (typeof ChartDataLabels !== 'undefined') ? [ChartDataLabels] : []
                    });

                    // Recompute gradient on resize to keep it crisp
                    if (resizeHandler) window.removeEventListener('resize', resizeHandler);
                    resizeHandler = () => {
                        const ds = salaryChartInstance.data.datasets[0];
                        ds.backgroundColor = makeGradient();
                        salaryChartInstance.update('none');
                    };
                    window.addEventListener('resize', resizeHandler);
                }

                // Init when DOM is ready
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initSalaryChart);
                } else {
                    initSalaryChart();
                }

                // Clean up on page hide (for PJAX/Turbo scenarios)
                window.addEventListener('pagehide', () => {
                    if (resizeHandler) window.removeEventListener('resize', resizeHandler);
                    if (salaryChartInstance) salaryChartInstance.destroy();
                });
            })();
        </script>
    @endif

@endsection
