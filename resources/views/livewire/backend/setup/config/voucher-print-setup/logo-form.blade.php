<div class="row">
    <form wire:submit.prevent="uploadLogo" method="POST">

        <div class="col-12">
            <x-input-field type="file" id="logo" label="Set Your Logo" model="logo" required />
        </div>

        <div class="mt-3 d-flex justify-content-between">
            <x-button type="submit" color="primary">
                Save
            </x-button>
            <x-button type="button" color="danger" onclick="confirmClearLogo()">
                Clear Logo
            </x-button>
        </div>

    </form>
</div>

@push('scripts')
    <script>
         // Function to show a modal based on a given uid for DELETE!
        function confirmClearLogo() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will not be able to restore this logo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7367f0',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Emit an event to show the modal with the given Livewire component uid for DELETE!
                    Livewire.emit('confirmLogo');
                }
            })
        }
    </script>
@endpush
