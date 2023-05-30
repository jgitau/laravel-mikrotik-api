<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Hotel Rooms
        </h5>
        <x-button color="close" dismiss="true" click="closeModal" />
    </div>
    <form wire:submit.prevent="updateHotelRoom" method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <x-input-field id="hmsConnect" label="HMS Connect" model="hmsConnect"
                        placeholder="Enter a HMS Connect.." required />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <x-button color="secondary" dismiss="true" click="closeModal">
                Close
            </x-button>
            <x-button type="submit" color="primary">
                Save Changes
            </x-button>
        </div>
    </form>
</div>
