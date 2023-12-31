// Function to show a modal based on a given uid for UPDATE!
function showAdmin(uid) {
  // Emit an event to show the modal with the given Livewire component uid for UPDATE!
  Livewire.emit('getAdmin', uid);
}

// Function to show a modal based on a given uid for DELETE!
function confirmDeleteAdmin(uid) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You will not be able to restore this data!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#7367f0',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(result => {
    if (result.isConfirmed) {
      // Emit an event to show the modal with the given Livewire component uid for DELETE!
      Livewire.emit('confirmAdmin', uid);
    }
  });
}

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
      { data: 'username', name: 'username' },
      { data: 'fullname', name: 'fullname' },
      { data: 'group.name', name: 'group.name' },
      { data: 'email', name: 'email' },
      { data: 'status', name: 'status' },
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
