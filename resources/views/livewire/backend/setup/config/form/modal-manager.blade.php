<div>
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!-- Livewire component will be rendered here -->

            <div class="modal-content">
                {{-- Router Form Edit --}}
                @if($livewireComponentName == 'form.edit-router')
                @livewire('backend.setup.config.form.edit-router')

                {{-- Clients Form Edit --}}
                @elseif($livewireComponentName == 'form.clients')
                @livewire('backend.setup.config.form.clients')

                {{-- Hotel Rooms Form Edit --}}
                @elseif($livewireComponentName == 'form.hotel_rooms')
                @livewire('backend.setup.config.form.hotel-rooms')

                {{-- Users Data Form Edit --}}
                @elseif($livewireComponentName == 'form.users_data')
                @livewire('backend.setup.config.form.users-data')

                {{-- Social Plugins Data Form Edit --}}
                @elseif($livewireComponentName == 'form.social_plugins')
                @livewire('backend.setup.config.form.social-plugins')

                @endif
            </div>
        </div>
        @push('scripts')
        <script>
            window.addEventListener('show-modal', () => {
                $('#modalCenter').modal('show');
            });
            window.addEventListener('hide-modal', () => {
            $('#modalCenter').modal('hide');
            });
        </script>
        @endpush
    </div>
</div>
