<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Router
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
    </div>
    <form wire:submit.prevent="updateRouter" method="POST">
        <div class="modal-body">
            {{-- Form Input Server IP Address, Mikrotik IP Address and API Port --}}
            <div class="row g-2 mb-3">
                <div class="col-4">
                    <label for="serverIpAddress" class="form-label">Server IP Address <span class="text-danger"><b>*</b></span></label>
                    <input type="text" id="serverIpAddress" class="form-control @error('server_ip_address') is-invalid @enderror" placeholder="Server IP Address" wire:model='server_ip_address'  />
                    @error('server_ip_address') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-4">
                    <label for="mikrotikIpAddress" class="form-label">Mikrotik IP Address <span class="text-danger"><b>*</b></span></label>
                    <input type="text" id="mikrotikIpAddress" class="form-control @error('mikrotik_ip_address') is-invalid @enderror" placeholder="Mikrotik IP Address" wire:model='mikrotik_ip_address' />
                    @error('mikrotik_ip_address') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-4">
                    <label for="apiPort" class="form-label">API Port <span class="text-danger"><b>*</b></span></label>
                    <input type="text" id="apiPort" class="form-control @error('mikrotik_api_port') is-invalid @enderror" placeholder="API Port" wire:model='mikrotik_api_port' />
                    @error('mikrotik_api_port') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Temporary Username and Temporary Password --}}
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <label for="temporaryUsername" class="form-label">Temporary Username <span class="text-danger"><b>*</b></span></label>
                    <input type="text" id="temporaryUsername" class="form-control @error('temporary_username') is-invalid @enderror" placeholder="Temporary Username" wire:model='temporary_username'  />
                    @error('temporary_username') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-6">
                    <label for="temporaryPassword" class="form-label">Temporary Password </label>
                    <input type="text" id="temporaryPassword" class="form-control" placeholder="Temporary Password" wire:model='temporary_password' />
                </div>
            </div>

            {{-- Form Input Radius Ports and Radius Secret --}}
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <label for="radiusPorts" class="form-label">Radius Port <span class="text-danger"><b>*</b></span></label>
                    <input type="text" id="radiusPorts" class="form-control @error('ports') is-invalid @enderror" placeholder="Radius Port" wire:model='ports'/>
                    @error('ports') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-6">
                    <label for="radiusSecret" class="form-label">Radius Secret <span class="text-danger"><b>*</b></span></label>
                    <input type="text" id="radiusSecret" class="form-control @error('secret') is-invalid @enderror" placeholder="Radius Secret" wire:model='secret' />
                    @error('secret') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
                Close
            </button>
            <button type="submit" class="btn btn-primary">Save Changes {{ session('error') }}</button>
        </div>
    </form>
    {{-- @push('scripts')
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
            toastr.success('Success!');
        });
    </script>
    @endpush --}}
</div>
