<div class="col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <div>
                <h5 class="card-title mb-0">Traffic Monitor</h5>
                {{-- <small class="text-muted">Commercial networks and enterprises</small> --}}
            </div>
            {{-- TODO: --}}
            {{-- <div class="card-header-elements ms-auto py-0">
                <h5 class="fw-bold mb-0 me-3">$ 78,000</h5>
                <span class="badge bg-label-secondary">
                    <i class="ti ti-arrow-up ti-xs text-success"></i>
                    <span class="align-middle">37%</span>
                </span>
            </div> --}}
        </div>
        <div class="card-body" wire:ignore>
            @if ($uploadTraffic && $downloadTraffic)
            <canvas id="chartTraffic" data-upload='@json($uploadTraffic)'
                data-download='@json($downloadTraffic)' style="min-height:200px;"></canvas>
            @endif
            {{-- <canvas id="chartTraffic"></canvas> --}}
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/backend/dashboard/chart.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/luxon.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/chartjs-adapter-luxon.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/chartjs-plugin-streaming.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/traffic-chart.js') }}"></script>
@endpush
