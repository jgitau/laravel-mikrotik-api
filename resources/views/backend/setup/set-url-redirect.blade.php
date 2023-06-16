@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Set URL Redirect')

@section('content')
@if($permissions['isAllowedToSetUrlRedirect'])
<h4 class="fw-bold py-3 mb-1"><span class="text-primary fw-light"></span>Set URL Redirect</h4>

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Form Set URL Redirect</h4>
                </div>
            </div>

            {{-- Start Form Set URL Redirect --}}
            <div class="card-body">
                @livewire('backend.setup.config.set-url-redirect.form')
            </div>
            {{-- End Form Set URL Redirect --}}

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
@endif
@endsection
