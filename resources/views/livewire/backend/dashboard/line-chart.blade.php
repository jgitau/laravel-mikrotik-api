<div class="col-12 mb-4">
    <div class="card">
        <div class="card-header header-elements">
            <div>
                <h5 class="card-title mb-0">Statistics</h5>
                <small class="text-muted">Commercial networks and enterprises</small>
            </div>
            <div class="card-header-elements ms-auto py-0">
                <h5 class="fw-bold mb-0 me-3">$ 78,000</h5>
                <span class="badge bg-label-secondary">
                    <i class="ti ti-arrow-up ti-xs text-success"></i>
                    <span class="align-middle">37%</span>
                </span>
            </div>
        </div>
        <div class="card-body" wire:ignore>
            <canvas id="chartTraffic"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon@1.27.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@2.0.0"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('chartTraffic').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Upload Traffic',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [],
            },{
                label: 'Download Traffic',
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                data: [],
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'realtime',
                    realtime: {
                        // TODO:
                        // duration: 20000,
                        // refresh: 1000,
                        // delay: 2000,
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
                        delay: 2000
                    }
                },
                y: {

                    title: {
                        display: true,
                        text: 'Traffic (kbps)'
                    }
                },

            }
        }
    });

    window.livewire.on('updateTrafficData', function (uploadTraffic, downloadTraffic) {
        console.log(uploadTraffic, downloadTraffic);
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

    // Set interval to refresh data every 5 seconds
    setInterval(() => {
        window.livewire.emit('loadTrafficData');
    }, 1000); // Update every 5 seconds

});
</script>
@endpush
