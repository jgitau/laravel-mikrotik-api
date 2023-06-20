@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'List Clients')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
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

            @if ($permissions['isAllowedToAddNewClient'])
            <x-button type="button" color="facebook" data-bs-toggle="modal" data-bs-target="#createNewClient">
                <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Add New Client
            </x-button>
            {{-- /Create Button for Add New Client --}}
            @endif
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
    <script>
        // Hide Modal
        window.addEventListener('hide-modal', () => {
            $('#createNewClient').modal('hide');
            $('#updateClientModal').modal('hide');
        });
        window.addEventListener('show-modal', () => {
            $('#updateClientModal').modal('show');
        });
    </script>
    @endpush
</div>
@endif

@if($permissions['isAllowedToEditClient'])
{{-- START FORM CREATE CLIENT --}}
{{-- @livewire('backend.client.create') --}}
{{-- END FORM CREATE CLIENT --}}
@endif
@if($permissions['isAllowedToDeleteClient'])
{{-- START FORM EDIT CLIENT --}}
{{-- @livewire('backend.client.edit') --}}
{{-- END FORM EDIT CLIENT --}}
@endif

@endsection
