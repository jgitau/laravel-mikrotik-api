<div class="table">
    <table class="table table-hover table-responsive display" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Group</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    @push('scripts')
    <script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
    <script>
        // Listen for 'message' event from the window
        window.addEventListener('message', event => {
            // Check if the event contains an error detail
            if (event.detail && event.detail.error) {
            const error = event.detail.error;
            // Display an error message using Swal.fire
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error,
            });
        }
        // Check if the event contains a success detail
        if (event.detail && event.detail.success) {
                const success = event.detail.success;
                // Display an success message using Swal.fire
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: success,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        // Function to show a modal based on a given name
        function showAdmin(uid) {
            // Emit an event to show the modal with the given Livewire component name
            Livewire.emit('getAdmin', uid);
        }

        // Listen for the refreshDatatable event
        Livewire.on('refreshDatatable', () => {
            $('#myTable').DataTable().ajax.reload(null, false);
        });

        let dataTable;

        // Function to initialize the DataTable
        function initializeDataTable() {
            dataTable = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                ajax: "{{ route('admin.getDataTable') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width:'10px', orderable: false, searchable: false},
                    {data: 'username', name: 'username'},
                    {data: 'fullname', name: 'fullname'},
                    {data: 'group.name', name: 'group.name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }

        // Initialize the DataTable when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            initializeDataTable();
        });

        // Listen for the showCreateModal event
        Livewire.on('refreshDatatable', () => {
            setTimeout(() => {
            dataTable.ajax.reload(null, false);
            }, 200);
        });
    </script>
    @endpush
</div>
