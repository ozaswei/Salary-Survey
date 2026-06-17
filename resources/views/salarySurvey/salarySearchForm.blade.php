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
            <div class="col-md-2 mb-2 d-flex justify-content-between flex-row">
                <button type="submit" class="btn btn-light">Find</button>
                <button type="submit" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>

    {{-- Optional badge row to echo query (only when values exist) --}}
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