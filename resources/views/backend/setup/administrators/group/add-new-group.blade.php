@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'Add New Group')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light">Groups </span>/ Add New Group</h4>

<div class="row">
    <!-- DataTable with Buttons -->
    <div class="col-md-12">
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header">
                <h4 class="card-title">Add New Group</h4>
            </div>

            {{-- Start Form Create Group --}}
            @livewire('backend.setup.administrator.group.create-group')
            {{-- End Form Create Group --}}

        </div>
    </div>
</div>
@push('scripts')
@endpush

@endsection