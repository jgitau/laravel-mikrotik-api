@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'List Clients')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endpush

@section('content')
{{-- Is Allowed User To List Clients --}}
@if($permissions['isAllowedToListClients'])
<h4 class="fw-bold py-3 mb-1">List Clients</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Table Clients</h4>

            <div>
                {{-- /Start Button for Create New Client --}}
                @if ($permissions['isAllowedToAddNewClient'])
                <x-button type="button" color="facebook " data-bs-toggle="modal"
                    data-bs-target="#createNewClient">
                    <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Add New Client
                </x-button>
                @endif
                {{-- /End Button for Create New Client --}}

                {{-- /Start Button for Batch Delete --}}
                @if ($permissions['isAllowedToDeleteClient'])
                <x-button type="button" color="danger" onclick="confirmDeleteBatch()">
                    <i class="tf-icons fas fa-trash-alt ti-xs me-1"></i>&nbsp; Batch Delete
                </x-button>
                @endif
                {{-- /End Button for Batch Delete --}}
            </div>

        </div>
    </div>

    @if($permissions['isAllowedToListClients'])
    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.client.list.data-table')
    </div>
    {{-- End List DataTable --}}
    @endif

    @push('scripts')
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script>
            // For Create New Client
            var validFrom = document.querySelector("#validFrom");
            var validTo = document.querySelector("#validTo");
            var dateOfBirth = document.querySelector("#dateOfBirth");
            validFrom.flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i"
            });
            validTo.flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i"
            });
            dateOfBirth.flatpickr({
                monthSelectorType: "static"
            });
            // FOr Update Client
            var validFromUpdate = document.querySelector("#validFromUpdate");
            var validToUpdate = document.querySelector("#validToUpdate");
            var dateOfBirthUpdate = document.querySelector("#dateOfBirthUpdate");
            validFromUpdate.flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i"
            });
            validToUpdate.flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i"
            });
            dateOfBirthUpdate.flatpickr({
                monthSelectorType: "static"
            });
    </script>
    <script>
        // Hide Modal
            window.addEventListener('hide-modal', () => {
                $('#createNewClient').modal('hide');
                $('#updateClientModal').modal('hide');
            });
            window.addEventListener('show-modal', () => {
                $('#updateClientModal').modal('show');
            });

            // Function to confirm Batch Delete
            function confirmDeleteBatch() {
                // Get all checked client_uid
                let client_uids = Array.from(document.querySelectorAll(".client-checkbox:checked")).map(el => el.value);

                // Check if at least one checkbox is checked
                if (client_uids.length > 0) {
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
                            // Emit an event to delete the checked clients
                            Livewire.emit('deleteBatch', client_uids);
                        }
                    });
                } else {
                    // If no checkbox is checked, show an error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You must select at least one client to delete!',
                    });
                }
            }
    </script>
    @endpush
</div>
@endif

{{-- TODO: --}}
@if($permissions['isAllowedToEditClient'])
{{-- START FORM CREATE CLIENT --}}
@livewire('backend.client.list.create')
{{-- END FORM CREATE CLIENT --}}
@endif
@if($permissions['isAllowedToDeleteClient'])
{{-- START FORM EDIT CLIENT --}}
@livewire('backend.client.list.edit')
{{-- END FORM EDIT CLIENT --}}
@endif

@endsection
