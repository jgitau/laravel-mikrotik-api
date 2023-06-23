<div wire:ignore class="table">
    <table class="table table-hover table-responsive display" id="myTable"
        data-route="{{ route('service.getDataTable') }}">
        <thead>
            <tr>
                <th>No</th>
                <th>Service Name</th>
                <th>Service Cost</th>
                <th>Idle Timeout</th>
                <th>Upload Rate</th>
                <th>Download Rate</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>


@push('scripts')
<script>
    // Helper function to show a Swal dialog
    function showSwalDialog(title, text, callback) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#7367f0',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }

    // Initialize DataTable when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        dataTable = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            order: [[0]], // order by the second column
            ajax: document.getElementById('myTable').dataset.route,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false },
                { data: 'service_name', name: 'service_name' },
                { data: 'currency_cost', name: 'currency_cost' },
                { data: 'idle_timeout', name: 'idle_timeout' },
                { data: 'upload_rate', name: 'upload_rate' },
                { data: 'download_rate', name: 'download_rate' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

    // Refresh DataTable when 'refreshDatatable' event is fired
    window.addEventListener('refreshDatatable', () => {
        dataTable.ajax.reload();
    });

    // Function to show a modal for UPDATE!
    function showService(id) {
        Livewire.emit('getService', id);
    }

    // Function to show a modal for DELETE!
    function confirmDeleteService(id) {
        showSwalDialog('Are you sure?', 'You will not be able to restore this data!', () => {
            Livewire.emit('confirmService', id);
        });
    }

</script>

@endpush
