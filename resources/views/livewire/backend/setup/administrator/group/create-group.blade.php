<div class="card-body">
    <form wire:submit.prevent="store" method="POST">
        <div class="row">
            <div class="col-12 mb-3">
                <label for="groupName">Group Name</label>
                <input type="text" class="form-control @error('groupName') is-invalid @enderror"
                placeholder="Group Name" name="groupName" id="groupName" wire:model="groupName">
                @error('groupName') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
        <h5>Permissions</h5>

        {{-- TODO: LIST PERMISSIONS --}}


        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>


    </form>

</div>
