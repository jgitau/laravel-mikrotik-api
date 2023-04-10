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
            <button type="button" class="btn btn-facebook waves-effect waves-light">
                <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp;Create
            </button>
            {{-- /Create Button for Add New Admin --}}
        </div>
    </div>

    {{-- Start List DataTable --}}
    @livewire('backend.setup.administrator.admin.data-table')
    {{-- End List DataTable --}}

</div>


@endsection
