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

    <!-- Add the modal placeholder here -->
    <div id="modal-placeholder"></div>

    @push('scripts')
    <script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
    <script>
        // Add the showModalByName function here
        function showModalByName(name) {
            let livewireComponentName = '';

            switch (name) {
                case 'exampleName1':
                    livewireComponentName = 'example-name1-form';
                    break;
                case 'exampleName2':
                    livewireComponentName = 'example-name2-form';
                    break;
                // Add more cases for other names here...
                default:
                    livewireComponentName = 'default-form';
            }

            // Insert the Livewire component into the modal placeholder
            $('#modal-placeholder').html(`<livewire:${livewireComponentName}>`);

            // Initialize the Livewire component
            Livewire.init();

            // Show the modal
            $('#modal-placeholder .modal').modal('show');
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
