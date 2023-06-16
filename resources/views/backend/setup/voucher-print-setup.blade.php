@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Vouchers Print Setup')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light"></span>Vouchers Print Setup</h4>

<div class="row">

    {{-- START HOTEL LOGO ALERT --}}
    {{-- TODO: --}}
    <div class="col-lg-12 mb-2">
        @livewire('backend.setup.config.voucher-print-setup.hotel-logo-alert')
    </div>
    {{-- END HOTEL LOGO ALERT --}}

    {{-- TODO: 2 COLUMN : 1 = Form, 2 = View Voucher --}}
    <div class="col-xl-8 col-md-7 col-sm-12 mb-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Form Vouchers Print Setup</h4>
                </div>
            </div>

            {{-- TODO: Voucher Print Setup FORM --}}
            {{-- Start Form Vouchers Print Setup --}}
            <div class="card-body">
                @livewire('backend.setup.config.voucher-print-setup.form')
            </div>
            {{-- End Form Vouchers Print Setup --}}


        </div>

        {{-- START LOGO FORM --}}
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Logo</h4>
                </div>
            </div>

            {{-- TODO: Logo Form --}}
            {{-- Start Logo --}}
            <div class="card-body">
                @livewire('backend.setup.config.voucher-print-setup.logo-form')
            </div>
            {{-- End Logo --}}
        </div>
        {{-- END LOGO FORM --}}

    </div>

    {{-- View Voucher --}}
    <div class="col-xl-4 col-md-5 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">View Vouchers</h4>
                </div>
            </div>

            {{-- TODO: View Voucher --}}
            {{-- Start View Vouchers --}}
            <div class="card-body">
                @livewire('backend.setup.config.voucher-print-setup.view')
            </div>
            {{-- End View Vouchers --}}

        </div>
    </div>



</div>

@push('scripts')

<script>
    // Listen for 'message' event from the window
    window.addEventListener('message', event => {
        // Check if the event contains an error detail
        if (event.detail && event.detail.error) {
            const error = event.detail.error;
            // Display an error message using Swal.fire
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error,
            });
        }
        // Check if the event contains a success detail
        if (event.detail && event.detail.success) {
            const success = event.detail.success;
            // Display an success message using Swal.fire
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: success,
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
</script>
@endpush
@endsection
