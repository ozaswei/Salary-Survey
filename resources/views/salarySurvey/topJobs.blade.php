<div class="card result-card p-4 fade-up top-jobs">
    <h4 class="mb-2 font-weight-bold">Top 5 Jobs Found</h4>
    <div class="row">
        @foreach ($topJobs as $item)
        <div class="col-md-12 d-flex mb-2">
            <div class="card job-card p-2 w-100 h-100">
                <h5 class="has-tip mb-0" data-tip="{{ $item['title'] }}" tabindex="0">
                    <span class="job-title">{{ $item['title'] }}</span>
                </h5>
                <p class="mb-1 text-white">{{ $item['company'] }}</p>
                <a href="{{ $item['link'] }}" target="_blank" rel="noopener"
                    class="btn btn-outline-light btn-sm mt-auto">View</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
