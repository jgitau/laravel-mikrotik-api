<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
    <div class="{{ (!empty($containerNav) ? $containerNav : 'container-fluid') }}">
        <div class="footer-container d-flex align-items-center justify-content-center py-2 flex-md-row flex-column">
            <div>
                © {{ date('Y') }}
                , Created by ❤️ <a
                    href="{{ (!empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '') }}"
                    target="_blank" class="fw-semibold">{{ (!empty(config('variables.creatorName')) ?
                    config('variables.creatorName') : '') }}</a>
            </div>
        </div>
    </div>
</footer>
<!--/ Footer-->

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
