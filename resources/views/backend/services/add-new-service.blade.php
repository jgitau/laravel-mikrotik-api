@extends('layouts/layoutMaster')
@section('title', 'Add New Service')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')

{{-- Is Allowed User To Add New Service --}}
@if($permissions['isAllowedToAddNewService'])
<h4 class="fw-bold py-3 mb-1"><span class="text-primary fw-light">Services </span>/ Add New Service</h4>

<div class="row">
    <!-- DataTable with Buttons -->
    <div class="col-md-12">
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Add New Service</h4>
                    <a href="{#" class="btn btn-sm btn-youtube text-white"
                        onclick="javascript:window.history.back(-1);return false;">
                        <i class="tf-icons fas fa-backward ti-xs me-1"></i>&nbsp; Back
                    </a>
                </div>
            </div>

            {{-- Start Form Create Service --}}
            @livewire('backend.service.list.create')
            {{-- End Form Create Service --}}

        </div>
    </div>
</div>
@endif

@endsection
