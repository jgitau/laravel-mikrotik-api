<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Router
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
    </div>
    <div class="modal-body">
        {{-- Form Input Server IP Address, Mikrotik IP Address and API Port --}}
        <div class="row g-2 mb-3">
            <div class="col-4">
                <label for="serverIpAddress" class="form-label">Server IP Address</label>
                <input type="text" id="serverIpAddress" class="form-control" placeholder="Server IP Address" />
            </div>
            <div class="col-4">
                <label for="mikrotikIpAddress" class="form-label">Mikrotik IP Address</label>
                <input type="text" id="mikrotikIpAddress" class="form-control" placeholder="Mikrotik IP Address" />
            </div>
            <div class="col-4">
                <label for="apiPort" class="form-label">API Port</label>
                <input type="text" id="apiPort" class="form-control" placeholder="API Port" />
            </div>
        </div>

        {{-- Form Input Temporary Username and Temporary Password --}}
        <div class="row g-2 mb-3">
            <div class="col-6">
                <label for="temporaryUsername" class="form-label">Temporary Username</label>
                <input type="text" id="temporaryUsername" class="form-control" placeholder="Temporary Username" />
            </div>
            <div class="col-6">
                <label for="temporaryPassword" class="form-label">Temporary Password</label>
                <input type="text" id="temporaryPassword" class="form-control" placeholder="Temporary Password" />
            </div>
        </div>

        {{-- Form Input Radius Ports and Radius Secret --}}
        <div class="row g-2 mb-3">
            <div class="col-6">
                <label for="radiusPorts" class="form-label">Radius Ports</label>
                <input type="text" id="radiusPorts" class="form-control" placeholder="Radius Ports" />
            </div>
            <div class="col-6">
                <label for="radiusSecret" class="form-label">Radius Secret</label>
                <input type="text" id="radiusSecret" class="form-control" placeholder="Radius Secret" />
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button type="button" class="btn btn-primary">Save Changes</button>
    </div>
</div>
