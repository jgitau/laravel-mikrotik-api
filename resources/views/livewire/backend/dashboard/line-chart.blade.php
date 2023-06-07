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
            <div id="chartTraffic" class="chart-apex" data-height="300"></div>
        </div>
    </div>
</div>

{{-- @push('scripts')
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script>
    document.addEventListener('livewire:load', function () {
        var uploadTrafficData = [];
        var downloadTrafficData = [];

        var chartOptions = {
            series: [
                {
                    name: 'Upload Traffic',
                    data: uploadTrafficData
                },
                {
                    name: 'Download Traffic',
                    data: downloadTrafficData
                }
            ],
            chart: {
                height: 300,
                type: 'line',
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 2000
                    }
                },
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime',
                range: 10000,
                labels: {
                    format: 'dd MMM yyyy HH:mm'
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value.toFixed(2) + ' kbps';
                    }
                }
            },
            legend: {
                show: true
            }
        };

        var chartTraffic = new ApexCharts(document.getElementById('chartTraffic'), chartOptions);
        chartTraffic.render();

        window.livewire.on('uploadTrafficUpdated', function (uploadTraffic) {
            uploadTrafficData.push({
                x: Date.now(),
                y: uploadTraffic
            });
            chartTraffic.updateSeries([
                {
                    name: 'Upload Traffic',
                    data: uploadTrafficData
                },
                {
                    name: 'Download Traffic',
                    data: downloadTrafficData
                }
            ]);
        });

        window.livewire.on('downloadTrafficUpdated', function (downloadTraffic) {
            downloadTrafficData.push({
                x: Date.now(),
                y: downloadTraffic
            });
            chartTraffic.updateSeries([
                {
                    name: 'Upload Traffic',
                    data: uploadTrafficData
                },
                {
                    name: 'Download Traffic',
                    data: downloadTrafficData
                }
            ]);
        });

        // This will call the loadTrafficData function every 1 second (1000ms)
        setInterval(function () {
            window.livewire.emit('callLoadTrafficData');
        }, 1000);
    });
</script>
@endpush --}}


@push('scripts')
{{-- APEX CHART JS --}}
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
{{-- TODO: Change chart to chart.js plugin streaming --}}
<script>
    document.addEventListener('livewire:load', function () {
        var uploadTrafficData = [];
        var downloadTrafficData = [];

        // Add initial data to the chart
        for (var i = 0; i < 100; i++) {
            uploadTrafficData.push({
                x: Date.now() - (100 - i) * 1000,
                y: 0
            });
            downloadTrafficData.push({
                x: Date.now() - (100 - i) * 1000,
                y: 0
            });
        }

        var chartOptions = {
            series: [
                {
                    name: 'Upload Traffic',
                    data: uploadTrafficData
                },
                {
                    name: 'Download Traffic',
                    data: downloadTrafficData
                }
            ],
            chart: {
                height: 300,
                type: 'line',
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 2000
                    }
                },
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime',
                range: 10000,
                labels: {
                    format: 'dd MMM yyyy HH:mm'
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value.toFixed(2) + ' kbps';
                    }
                }
            },
            legend: {
                show: true
            }
        };

        var chartTraffic = new ApexCharts(document.getElementById('chartTraffic'), chartOptions);
        chartTraffic.render();

        window.livewire.on('uploadTrafficUpdated', function (uploadTraffic) {
            uploadTrafficData.push({
                x: Date.now(),
                y: uploadTraffic
            });
            updateChart();
        });

        window.livewire.on('downloadTrafficUpdated', function (downloadTraffic) {
            downloadTrafficData.push({
                x: Date.now(),
                y: downloadTraffic
            });
            updateChart();
        });

        function updateChart() {
            chartTraffic.updateSeries([
                {
                    name: 'Upload Traffic',
                    data: uploadTrafficData.slice(-100)
                },
                {
                    name: 'Download Traffic',
                    data: downloadTrafficData.slice(-100)
                }
            ]);
        }

        setInterval(function () {
            window.livewire.emit('callLoadTrafficData');
        }, 1000);

        // Add a slight delay to the chart update to make it smoother
        setInterval(updateChart, 900);
    });
</script>
@endpush
