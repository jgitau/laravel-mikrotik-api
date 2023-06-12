document.addEventListener('livewire:load', function () {
    var chartElement = document.getElementById('userActiveChart');
    var data = JSON.parse(chartElement.getAttribute('data-chart'));

    if (data) {
        var polarChartVar = new Chart(chartElement, {
        type: 'doughnut',
        data: {
            labels: [
            'User Active : ' + data.userActive,
            'Bypassed : ' + data.ipBindingBypassed,
            'Blocked : ' + data.ipBindingBlocked
            ],
            datasets: [
            {
                data: [data.userActive, data.ipBindingBypassed, data.ipBindingBlocked],
                backgroundColor: [
                'rgba(54, 162, 235, 0.4)', // color for User Active
                'rgba(255, 206, 86, 0.4)', // color for Bypassed
                'rgba(255, 99, 132, 0.4) ' // color for Blocked
                ],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
            duration: 500
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
            tooltip: {
                callbacks: {
                label: function (context) {
                    var label = context.label || '';
                    if (label) {
                    label = label.split(':');
                    return label[0] + ': ' + context.raw;
                    }
                }
                }
            }
            }
        }
        });
    }
});
