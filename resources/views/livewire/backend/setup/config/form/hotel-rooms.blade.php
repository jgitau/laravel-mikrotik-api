<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Hotel Rooms
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal"></button>
    </div>
    <form wire:submit.prevent="updateHotelRoom" method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <label for="hmsConnect" class="form-label">HMS Connect</label>
                    <input type="text" id="hmsConnect" class="form-control @error('hmsConnect') is-invalid @enderror"
                        placeholder="HMS Connect" wire:model="hmsConnect" />
                    @error('hmsConnect') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
                Close
            </button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
