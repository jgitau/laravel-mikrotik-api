@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'List Groups')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light">Groups </span>/ List</h4>

<div class="row">
    <!-- DataTable with Buttons -->
    <div class="col-md-8">
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Table Groups</h4>
                </div>
            </div>

            {{-- Start List DataTable --}}
            @livewire('backend.setup.administrator.group.data-table')
            {{-- End List DataTable --}}

        </div>
    </div>


    {{-- TODO: --}}
    {{-- <div class="col-md-4">
        <div class="card mb-4">
            <h5 class="card-header">Create New Group</h5>

            @livewire('backend.setup.administrator.group.create-group')

        </div>
    </div> --}}
</div>
@push('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
@endpush

@endsection
