<div class="card result-card p-4 fade-up">
    <h2 class="mb-3">
        How much does a <span class="text-primary">{{ $job }}</span> earn in
        <span class="text-primary">{{ $location }}</span>?
    </h2>
    <p>
        Between <strong>CAD {{ number_format($lowest) }}</strong> and
        <strong>CAD {{ number_format($highest) }}</strong> annually.
    </p>
    <div class="average-pay mb-4">CAD {{ number_format($average) }} / Year</div>
    <div class="chart-container">
        <canvas id="salaryChart"></canvas>
    </div>
</div>