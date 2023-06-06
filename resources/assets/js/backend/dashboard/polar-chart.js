document.addEventListener('livewire:load', function () {
  var chartElement = document.getElementById('userActiveChart');
  var data = JSON.parse(chartElement.getAttribute('data-chart'));

  if (data) {
    var polarChartVar = new Chart(chartElement, {
      type: 'polarArea',
      data: {
        labels: ['User Active', 'Bypassed', 'Blocked'],
        datasets: [
          {
            data: [data.userActive, data.ipBindingBypassed, data.ipBindingBlocked, data.ipBindingRegular],
            backgroundColor: [
              'rgba(255, 99, 132, 0.6)', // color for User Active
              'rgba(54, 162, 235, 0.6)', // color for Bypassed
              'rgba(255, 206, 86, 0.6)' // color for Blocked
            ],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
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
              formatter: function (value, context) {
                return value;
              }
            }
          }
        ]
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
              stepSize: 1
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
          }
        }
      }
    });
  }
});
