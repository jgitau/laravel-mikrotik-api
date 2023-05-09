<div class="row">
    <form action="#" method="POST">
        {{-- *** TODO: *** --}}
        <div class="row">
            <div class="col-12 mb-3">
                <label for="serviceName" class="form-label">Service Name</label>
                <input type="text" id="serviceName" class="form-control @error('serviceName') is-invalid @enderror"
                    placeholder="Service Name" wire:model="serviceName" />
                @error('serviceName') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-12">
                <label for="cronType" class="form-label">Cron Type</label>
                <input type="text" id="cronType" class="form-control @error('cronType') is-invalid @enderror"
                    placeholder="Cron Type" wire:model="cronType" />
                @error('cronType') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-end">
            <button type="button" class="btn btn-primary">Submit</button>
        </div>

    </form>
</div>
