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
                data-download='@json($downloadTraffic)' height="80"></canvas>
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
<script>
function bitToSize(bit) {
    var sizes = ['bps', 'Kbps', 'Mbps', 'Gbps', 'Tbps'];
    if (bit == 0) {
        return '0';
    }
    var i = parseInt(Math.floor(Math.log(bit) / Math.log(1000)));
    if (sizes[i] === undefined) {
        return 'Loading';
    }
    if (i == 0) return bit + ' ' + sizes[i];
    return (bit / Math.pow(1000, i)).toFixed(1) + ' ' + sizes[i];
}

document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('chartTraffic');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Upload Traffic',
                backgroundColor: 'rgba(26, 159, 227,0.8)',
                borderColor: 'rgba(26, 159, 227,1)',
                fill: false,
                tension: 0.4,
                pointRadius: 0,
                data: [],
            },{
                label: 'Download Traffic',
                backgroundColor: 'rgba(40, 206, 97, 0.8)',
                borderColor: 'rgba(40, 206, 97, 1)',
                fill: false,
                tension: 0.4,
                pointRadius: 0,
                data: [],
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'realtime',
                    realtime: {
                        duration: 20000,
                        refresh: 1000,
                        delay: 2000,
                        onRefresh: function(chart) {
                            chart.data.datasets[0].data.push({
                                x: Date.now(),
                                y: @this.uploadTraffic
                            });
                            chart.data.datasets[1].data.push({
                                x: Date.now(),
                                y: @this.downloadTraffic
                            });
                        },
                    },
                    title: {
                        display: true,
                        text: 'Time'
                    },

                },
                y: {
                    title: {
                        display: true,
                        text: 'Traffic'
                    },
                    ticks: {
                        callback: function(value, index, values) {
                            return bitToSize(value);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    mode: 'nearest',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            const value = context.parsed.y;
                            label += bitToSize(value);
                            return label;
                        }
                    }
                },
                streaming: {
                    frameRate: 30  // Smoother rendering with 30 data points per second
                }
            }
        }
    });

    window.livewire.on('updateTrafficData', function (uploadTraffic, downloadTraffic) {
        chart.data.datasets[0].data.push({
            x: Date.now(),
            y: uploadTraffic
        });
        chart.data.datasets[1].data.push({
            x: Date.now(),
            y: downloadTraffic
        });
        chart.update('quiet');
    });

    // Set interval to refresh data every 2 seconds
    setInterval(() => {
        window.livewire.emit('loadTrafficData');
    }, 2000); // Update every 2 seconds

});
</script>
@endpush
