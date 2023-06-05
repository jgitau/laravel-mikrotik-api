@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'List Configs')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')
{{-- Is Allowed User To List Config --}}
@if($isAllowedToListConfig)
<h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light">Configs </span>/ List</h4>

<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Table Configs</h4>
            <!-- Vertically Centered Modal -->
        </div>
    </div>


    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.setup.config.data-table')
    </div>
    {{-- End List DataTable --}}

    <!-- Add the ModalManager Livewire component -->
    @livewire('backend.setup.config.form.modal-manager')

    @push('scripts')
    <script>
        window.addEventListener('closeModal', event =>{
            $('#modalCenter').modal('hide');
        });
    </script>

    @endpush

</div>

@endif

@endsection
