<div class="table" style="padding: 0 30px 30px 30px;">
    <table class="table table-hover table-responsive display" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
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
        function showModalByName(name) {
            let livewireComponentName = '';
            let resetFormFunctionName = '';
            switch (name) {
                // Router
                case 'edit_router':
                    livewireComponentName = 'form.edit-router';
                    resetFormFunctionName = 'resetForm';
                break;
                // Clients
                case 'clients':
                    livewireComponentName = 'form.clients';
                    resetFormFunctionName = 'resetForm';
                break;
                // Hotel Rooms
                case 'hotel_rooms':
                    livewireComponentName = 'form.hotel_rooms';
                    resetFormFunctionName = 'resetForm';
                break;
                // Users Data
                case 'users_data':
                    livewireComponentName = 'form.users_data';
                break;
                // Social Plugins
                case 'social_plugins':
                    livewireComponentName = 'form.social_plugins';
                break;
                // Ads
                case 'ads':
                    livewireComponentName = 'form.ads';
                break;
                // Add more cases for other names here...
                default:
                    livewireComponentName = 'form.edit-router';
                    resetFormFunctionName = 'resetForm';
            }
            // Call the resetForm method before showing the modal
            if (resetFormFunctionName) {
                Livewire.emit(resetFormFunctionName);
            }

            // Emit an event to show the modal with the given Livewire component name
            Livewire.emit('showModal', livewireComponentName);
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
                ajax: "{{ route('config.getDataTable') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'10px', orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }

        // Initialize the DataTable when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            initializeDataTable();
        });
        Livewire.on('refreshDatatable', () => {
            setTimeout(() => {
                dataTable.ajax.reload(null, false);
            }, 500);
        });
    </script>
    @endpush


</div>
