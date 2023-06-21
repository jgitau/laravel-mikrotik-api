// Function to show a modal based on a given uid for UPDATE!
let dataTable;

// Function to initialize the DataTable
function initializeDataTable() {
  dataTable = $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    order: [[0]],
    ajax: document.getElementById('myTable').dataset.route,
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false },
      { data: 'name', name: 'name' },
      { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
}
// Initialize the DataTable when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
  initializeDataTable();
});

// Listen for the showCreateModal event
window.addEventListener('refreshDatatable', event => {
  dataTable.ajax.reload();
});
