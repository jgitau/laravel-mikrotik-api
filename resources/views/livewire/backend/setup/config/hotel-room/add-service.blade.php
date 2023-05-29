<div class="row">
    <form wire:submit.prevent="storeService" method="POST">
        <div class="row">

            <div class="col-12 mb-3">
                <label for="idService" class="form-label">Service Name <span class="text-danger"><b>*</b></span></label>
                <select name="idService" id="idService" class="form-select @error('idService') is-invalid @enderror"
                    wire:model="idService">
                    <option value="">-- Choice Service Name --</option>
                    @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                    @endforeach
                </select>
                @error('idService') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-12">
                <label for="cronType" class="form-label">Cron Type <span class="text-danger"><b>*</b></span></label>
                <input type="text" id="cronType" class="form-control @error('cronType') is-invalid @enderror"
                    placeholder="Cron Type" wire:model="cronType" />
                @error('cronType') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>


    </form>
</div>
