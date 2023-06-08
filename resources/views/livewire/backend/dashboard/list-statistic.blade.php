<div class="col-xl-12 mb-4 col-lg-12 col-12">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="card-title mb-0">Statistics</h3>
                {{-- <small class="text-muted">Updated 1 month ago</small> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="row gy-3">

                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-primary me-3 p-2">
                            <i class="fa-solid fa-server ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" wire:ignore id="cpuLoad">0%</h5>
                            <small>CPU Load</small>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-info me-3 p-2">
                            <i class="fa-solid fa-network-wired ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">8.549k</h5>
                            <small>Total PPPoE Secret</small>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-danger me-3 p-2">
                            <i class="fa-solid fa-network-wired ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">{{ $activeHotspots }}</h5>
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

                {{-- <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-twitter me-3 p-2">
                            <i class="fa-solid fa-circle-info ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">Info</h5>
                            <small class="mb-0">Model :</small>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-google-plus me-3 p-2">
                            <i class="fa-solid fa-memory ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">{{ $freeMemoryPercentage }}</h5>
                            <small>Free Memory</small>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-instagram me-3 p-2">
                            <i class="fa-solid fa-ethernet ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">$9745</h5>
                            <small>PPPoE Active</small>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="badge rounded-pill bg-label-vimeo me-3 p-2">
                            <i class="fa-solid fa-wifi ti-sm"></i>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">$9745</h5>
                            <small>Total User Hotspot</small>
                        </div>
                    </div>
                </div> --}}


            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    let updateInterval;

    document.addEventListener('DOMContentLoaded', function () {
        updateInterval = setInterval(function() {
            // Call the Livewire method to load the new CPU data and uptime
            @this.call('loadCpuDataAndUptime');
        }, 2000); // Update every 2 seconds
    });

    // Listen for the cpuLoadUpdated and uptimeUpdated events
    window.livewire.on('cpuLoadUpdated', cpuLoad => {
        document.getElementById('cpuLoad').innerText = cpuLoad;
    });

    window.livewire.on('uptimeUpdated', uptime => {
        document.getElementById('uptime').innerText = uptime;
    });

    // Listen for the error event and stop updates if an error occurs
    window.livewire.on('error', error => {
        clearInterval(updateInterval);
    });
</script>
@endpush
