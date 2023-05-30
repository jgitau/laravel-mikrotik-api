@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'List Admins')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light">Administrators </span>/ List</h4>

<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Table Admins</h4>

            <x-button type="button" color="facebook" data-bs-toggle="modal"
                data-bs-target="#createNewAdmin">
                <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Add new Admin
            </x-button>
            {{-- /Create Button for Add New Admin --}}
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.setup.administrator.admin.data-table')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    <script>
        // Hide Modal
        window.addEventListener('hide-modal', () => {
            $('#createNewAdmin').modal('hide');
            $('#updateAdminModal').modal('hide');
        });
        window.addEventListener('show-modal', () => {
            $('#updateAdminModal').modal('show');
        });
    </script>
    @endpush
</div>

@livewire('backend.setup.administrator.admin.create')
@livewire('backend.setup.administrator.admin.edit')
@endsection
