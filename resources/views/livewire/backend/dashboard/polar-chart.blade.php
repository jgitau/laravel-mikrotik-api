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
            <canvas id="userActiveChart" class="chartjs" data-height="360"></canvas>
            @endif
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("livewire:load", function () {
        var data = @json($chartData);

        if (data) {
            var ctx = document.getElementById('userActiveChart');
            var polarChartVar = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: ['User Active', 'Bypassed', 'Blocked'],
                    datasets: [{
                        data: [
                            data.userActive,
                            data.ipBindingBypassed,
                            data.ipBindingBlocked,
                            data.ipBindingRegular
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',   // color for User Active
                            'rgba(54, 162, 235, 0.6)',   // color for Bypassed
                            'rgba(255, 206, 86, 0.6)',   // color for Blocked
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1,
                        datalabels: {
                            display: true,
                            color: 'rgba(255, 255, 255, 1)',
                            anchor: 'end',
                            align: 'end',
                            offset: 8,
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: function(value, context) {
                                return value;
                            }
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 500
                    },
                    scales: {
                        r: {
                            ticks: {
                                display: true,
                                stepSize: 1,
                            },
                            grid: {
                                display: true
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                boxWidth: 8,
                                boxHeight: 8
                            }
                        },
                    }
                }
            });
        }
    });
</script>
@endpush
