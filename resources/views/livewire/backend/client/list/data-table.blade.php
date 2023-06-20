<div wire:ignore class="table">
    <table class="table table-hover table-responsive display" id="myTable">
        <thead>
            <tr>
                <th id="th-1">
                    <input class="form-check-input" style="border: 1px solid #8f8f8f;" type='checkbox' id='select-all-checkbox'>
                </th>
                <th>No</th>
                <th>Username</th>
                <th>Service</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    @push('scripts')
    <script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
    {{-- TODO: --}}
    <script>
        // Function to show a modal based on a given uid for UPDATE!
        function showClient(uid) {
            // Emit an event to show the modal with the given Livewire component uid for UPDATE!
            Livewire.emit('getClient', uid);
        }

        // // Function to show a modal based on a given uid for DELETE!
        function confirmDeleteClient(uid) {
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
                    Livewire.emit('confirmClient', uid);
                }
            })
        }

        // TODO: DELETE WITH CHECKBOX
        // Add an event listener to the 'select all' checkbox

        document.getElementById('select-all-checkbox').addEventListener('click', function(event) {
        // Get all the checkboxes with the class 'client-checkbox'
        let checkboxes = document.getElementsByClassName('client-checkbox');

        // Iterate through all the checkboxes and set their checked property to the same as the 'select all' checkbox
        for (let i = 0; i < checkboxes.length; i++) { checkboxes[i].checked=event.target.checked; } });

        let dataTable;

        // Function to initialize the DataTable
        function initializeDataTable() {
            dataTable = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                "order": [[ 2, "asc" ]], // order by the second column
                ajax: "{{ route('client.getDataTable') }}",
                columns: [
                    {
                        data: 'client_uid',
                        render: function(data, type, row) {
                            return `<input type='checkbox' style='border: 1px solid #8f8f8f;' class='form-check-input client-checkbox' value='${data}'>`;
                        },
                        orderable: false,
                        searchable: false,
                        width:'15px'
                    },
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width:'10px', orderable: false, searchable: false},
                    {data: 'username', name: 'username'},
                    {data: 'service_name', name: 'service_name'},
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
