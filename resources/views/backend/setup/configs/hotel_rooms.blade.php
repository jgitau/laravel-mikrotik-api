@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'List Configs')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light">Configs </span>/ Hotel Rooms</h4>

<!-- DataTable with Buttons -->
<div class="row">

    {{-- TODO: Create New Service --}}
    <div class="col-12 mb-3">

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Add New Service</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-5">
                            <label for="hmsConnect" class="form-label">HMS Connect</label>
                            <input type="text" id="hmsConnect" class="form-control @error('hmsConnect') is-invalid @enderror"
                                placeholder="HMS Connect" wire:model="hmsConnect" />
                            @error('hmsConnect') <small class="error text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Table Registered Service</h4>
                </div>
            </div>

            {{-- Start List DataTable --}}
            {{-- TODO: --}}
            <div class="card-body">
                @livewire('backend.setup.config.hotel-room.data-table')
            </div>
            {{-- End List DataTable --}}

            <!-- Add the ModalManager Livewire component -->
            {{-- TODO: --}}
            {{-- @livewire('backend.setup.config.form.modal-manager')

            @push('scripts')
            <script>
                window.addEventListener('closeModal', event =>{
                    $('#modalCenter').modal('hide');
                });
            </script>
            @endpush --}}

        </div>
    </div>


</div>
@endsection
