<div class="col-lg-6 col-12 mb-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">User Active</h5>
        </div>
        <div class="card-body">
            @if ($chartData)
            <div id="userActiveChart" data-chart='@json($chartData)'></div>
            @endif
            {{-- <div id="userActiveChart"></div> --}}
        </div>

    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/backend/dashboard/polar-chart.js') }}"></script>
@endpush
