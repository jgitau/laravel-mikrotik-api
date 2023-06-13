<div class="col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <div>
                <h5 class="card-title mb-0">Traffic Monitor</h5>
                {{-- <small class="text-muted">Commercial networks and enterprises</small> --}}
            </div>
        </div>
        <div class="card-body">
            <canvas id="chartTraffic" wire:ignore data-upload='@json($uploadTraffic)'
                data-download='@json($downloadTraffic)' style="min-height:250px;"></canvas>
            {{-- <canvas id="chartTraffic"></canvas> --}}
        </div>
    </div>
</div>

@push('scripts')
<script>
    // When load page finished
    document.addEventListener('DOMContentLoaded', (event) => {
        // Get data from api
        Livewire.emit('getLoadTrafficData');
    });
</script>
<script src="{{ asset('assets/js/backend/dashboard/chart.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/luxon.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/chartjs-adapter-luxon.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/chartjs-plugin-streaming.js') }}"></script>
<script src="{{ asset('assets/js/backend/dashboard/traffic-chart.js') }}"></script>
@endpush
