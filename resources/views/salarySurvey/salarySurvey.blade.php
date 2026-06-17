@extends('salarySurvey.layouts.main')

@section('customHeader')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
@endsection

@section('customStyle')
@endsection

@section('mainBody')
    <div class="site-bg" aria-hidden="true"></div>
    <div class="site-noise" aria-hidden="true"></div>

    <div class="container mt-4">
        <!-- Search Form -->
        @include('salarySurvey.salarySearchForm')
        @if ($results == true)
            <div class="row">
                <div class="col-md-8 col-8 col-lg-8 col-sm-12">
                    <!-- Salary Display Card -->
                    @include('salarySurvey.salaryDisplayCard')
                </div>
                <div class="col-md-4 col-4 col-lg-4 col-sm-12">
                    <!-- Top Jobs Found -->
                    @if (!empty($topJobs) && is_array($topJobs))
                        @include('salarySurvey.topJobs')
                    @else
                        <p>No jobs found for this title:(</p>
                    @endif
                </div>
            </div>
        @else
            <!-- Default Info Description -->
            @include('salarySurvey.defaultInfo')
        @endif
    </div>

    @if ($results == true)
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <!-- ChartJs scripts -->
        <script>
            (function() {
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

                    const labels = ['Starting', 'Average', 'Highest'];
                    const fmt = new Intl.NumberFormat('en-CA', {
                        maximumFractionDigits: 0
                    });

                    if (salaryChartInstance?.destroy) salaryChartInstance.destroy();

                    salaryChartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [{
                                data: [LOW, AVG, HIGH],
                                borderColor: '#7c9aff',
                                borderWidth: 2,
                                backgroundColor: makeGradient(),
                                fill: true,
                                tension: .35,
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
                                false : {
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
