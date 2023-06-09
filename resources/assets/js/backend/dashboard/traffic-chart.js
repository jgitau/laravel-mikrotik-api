// Function to convert bit to size with appropriate units
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

// Event listener for when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
  // Get the canvas element
  var ctx = document.getElementById('chartTraffic');

  // Get the data from the canvas element's data attributes
  var uploadTraffic = JSON.parse(ctx.getAttribute('data-upload'));
  var downloadTraffic = JSON.parse(ctx.getAttribute('data-download'));

  // Create a new Chart instance
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      datasets: [
        {
          // Configuration for the upload traffic dataset
          label: 'Upload Traffic',
          backgroundColor: 'rgba(26, 159, 227,0.8)',
          borderColor: 'rgba(26, 159, 227,1)',
          fill: false,
          tension: 0.4,
          pointRadius: 0,
          data: []
        },
        {
          // Configuration for the download traffic dataset
          label: 'Download Traffic',
          backgroundColor: 'rgba(40, 206, 97, 0.8)',
          borderColor: 'rgba(40, 206, 97, 1)',
          fill: false,
          tension: 0.4,
          pointRadius: 0,
          data: []
        }
      ]
    },
    options: {
      scales: {
        x: {
          type: 'realtime',
          realtime: {
            duration: 20000,
            refresh: 1000,
            delay: 2000,
            onRefresh: function (chart) {
              // Refresh function to update the datasets with new data
              chart.data.datasets[0].data.push({
                x: Date.now(),
                y: uploadTraffic
              });
              chart.data.datasets[1].data.push({
                x: Date.now(),
                y: downloadTraffic
              });
            }
          },
          title: {
            display: true,
            text: 'Time'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Traffic'
          },
          ticks: {
            callback: function (value, index, values) {
              // Callback to convert the y values to appropriate units
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
            label: function (context) {
              // Callback to format the tooltip label
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
          frameRate: 30 // Smoother rendering with 30 data points per second
        }
      }
    }
  });

  // Event listener for when new traffic data is received
  window.livewire.on('updateTrafficData', function (uploadTraffic, downloadTraffic) {
    // Update the datasets with the new data
    chart.data.datasets[0].data.push({
      x: Date.now(),
      y: uploadTraffic
    });
    chart.data.datasets[1].data.push({
      x: Date.now(),
      y: downloadTraffic
    });
    // Update the chart quietly without triggering the transition animation
    chart.update('quiet');
  });

  // Set an interval to refresh the data every 2 seconds
  setInterval(() => {
    // Emit an event to load new traffic data
    window.livewire.emit('loadTrafficData');
  }, 2000); // Update every 2 seconds
});
