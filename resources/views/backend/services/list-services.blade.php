@extends('layouts/layoutMaster')
@section('title', 'List Services')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endpush

@section('content')
{{-- Is Allowed User To List Services --}}
@if($permissions['isAllowedToListServices'])
<h4 class="fw-bold py-3 mb-1">List Services</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Table Services</h4>

            <div>
                {{-- /Start Button for Create New Service --}}
                @if ($permissions['isAllowedToAddNewService'])
                <a href="{{ route('backend.services.add-new-service') }}" class="btn btn-facebook text-white">
                    <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Add New Service
                </a>
                @endif
                {{-- /End Button for Create New Service --}}

            </div>

        </div>
    </div>

    @if($permissions['isAllowedToListServices'])
    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.service.list.data-table')
    </div>
    {{-- End List DataTable --}}
    @endif

    @push('scripts')
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/backend/service/service-management.js') }}"></script> --}}
    @endpush
</div>
@endif

@endsection
