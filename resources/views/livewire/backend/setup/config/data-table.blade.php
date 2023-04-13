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
        // Add the showModalByName function here
        function showModalByName(name) {
            let livewireComponentName = '';
            switch (name) {
                // Router
                case 'edit_router':
                    livewireComponentName = 'form.edit-router';
                break;
                // Clients
                case 'clients':
                    livewireComponentName = 'form.clients';
                break;
                // Hotel Rooms
                case 'hotel_rooms':
                    livewireComponentName = 'form.hotel_rooms';
                break;
                // Users Data
                case 'users_data':
                    livewireComponentName = 'form.users_data';
                break;
                // Social Plugins
                case 'social_plugins':
                livewireComponentName = 'form.social_plugins';
                break;
                // Add more cases for other names here...
                default:
                    livewireComponentName = 'form.edit-router';
            }

            // Emit an event to show the modal with the given Livewire component name
            Livewire.emit('showModal', livewireComponentName);
        }

        $(document).ready(function() {
            $('#myTable').DataTable({
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
        });
    </script>
    @endpush


</div>
