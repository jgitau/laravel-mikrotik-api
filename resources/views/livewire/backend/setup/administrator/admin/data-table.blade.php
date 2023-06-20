<div wire:ignore class="table">
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
        // Function to show a modal based on a given uid for UPDATE!
        function showAdmin(uid) {
            // Emit an event to show the modal with the given Livewire component uid for UPDATE!
            Livewire.emit('getAdmin', uid);
        }

        // Function to show a modal based on a given uid for DELETE!
        function confirmDeleteAdmin(uid) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will not be able to restore this data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7367f0',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Emit an event to show the modal with the given Livewire component uid for DELETE!
                    Livewire.emit('confirmAdmin', uid);
                }
            })
        }

        let dataTable;

        // Function to initialize the DataTable
        function initializeDataTable() {
            dataTable = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                "order": [[ 1, "asc" ]],
                ajax: "{{ route('admin.getDataTable') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width:'10px', orderable: false, searchable: false},
                    {data: 'username', name: 'username'},
                    {data: 'fullname', name: 'fullname'},
                    {data: 'group.name', name: 'group.name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }

        // Initialize the DataTable when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            initializeDataTable();
        });
        // Listen for the showCreateModal event
        window.addEventListener('refreshDatatable', event =>{
            dataTable.ajax.reload();
        });
    </script>
    @endpush
</div>
