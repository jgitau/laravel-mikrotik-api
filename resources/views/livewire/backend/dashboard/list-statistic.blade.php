<div class="col-xl-12 mb-4 col-lg-12 col-12">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="card-title mb-0">Statistics</h3>
                {{-- <small class="text-muted">Updated 1 month ago</small> --}}
            </div>
        </div>
        @if ($pollingInterval)
        <div class="card-body" wire:poll.{{ $pollingInterval }}ms="loadData">
        @else
        <div class="card-body">
        @endif
            <div class="row gy-3">

                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-primary me-3 p-2">
                            <i class="fa-solid fa-server ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" id="cpuLoad">{{ $cpuLoad }}</h5>
                            <small>CPU Load</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-danger me-3 p-2">
                            <i class="fa-solid fa-network-wired ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" id="activeHotspots">{{ $activeHotspots }}</h5>
                            <small>Hotspot Active</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-warning me-3 p-2">
                            <i class="fa-solid fa-clock ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <!-- Add id "uptime" to the h5 element -->
                            <h5 id="uptime" class="mb-0">{{ $uptime }}</h5>
                            <small>Uptime</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-google-plus me-3 p-2">
                            <i class="fa-solid fa-memory ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" id="freeMemoryPercentage">{{ $freeMemoryPercentage }}</h5>
                            <small>Free Memory</small>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@push('scripts')
@endpush
