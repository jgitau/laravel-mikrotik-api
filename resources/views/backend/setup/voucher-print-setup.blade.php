@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Vouchers Print Setup')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light"></span>Vouchers Print Setup</h4>

<div class="row">

    {{-- TODO: 2 COLUMN : 1 = Form, 2 = View Voucher --}}
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Form Vouchers Print Setup</h4>
                </div>
            </div>

            {{-- TODO: Voucher Print Setup FORM --}}
            {{-- Start Form Vouchers Print Setup --}}
            <div class="card-body">
                {{-- @livewire('backend.setup.config.set-url-redirect.form') --}}
            </div>
            {{-- End Form Vouchers Print Setup --}}

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

        </div>
    </div>
</div>
@endsection
