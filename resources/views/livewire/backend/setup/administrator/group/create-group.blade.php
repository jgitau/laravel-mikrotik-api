<div class="card-body">
    <form method="post" wire:submit.prevent="store">
        @csrf
        {{-- Input Name --}}
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                placeholder="Enter Name" aria-describedby="NameInput" wire:model="name">
            @error('name') <small class="error text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Button Create --}}
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-sm btn-facebook waves-effect waves-light " style="width: 100%">
                <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp;Create
            </button>
        </div>

    </form>

    @push('scripts')
    <script>
        window.addEventListener('showToast', function () {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success('Group added successfully!');
        });
    </script>
    @endpush


</div>
