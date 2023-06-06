<div class="col-lg-6 col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">User Active</h5>
            {{-- *** TODO: *** --}}
            {{-- <div class="card-header-elements ms-auto py-0 dropdown">
                <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                </div>
            </div> --}}
        </div>
        <div class="card-body">
            @if ($chartData)
            {{-- <canvas id="userActiveChart" class="chartjs" data-height="360"></canvas> --}}
            <canvas id="userActiveChart" class="chartjs" data-height="360" data-chart='@json($chartData)'></canvas>
            @endif
        </div>

    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/backend/dashboard/polar-chart.js') }}"></script>
@endpush
