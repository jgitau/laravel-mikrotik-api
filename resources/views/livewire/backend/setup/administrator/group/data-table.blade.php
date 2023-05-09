<div wire:ignore class="table" >
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
        let dataTable;

        function initializeDataTable() {
            dataTable = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                ajax: "{{ route('group.getDataTable') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
        initializeDataTable();
        });

        window.addEventListener('groupStored', event =>{
            dataTable.ajax.reload();
        });
    </script>
    @endpush
</div>
