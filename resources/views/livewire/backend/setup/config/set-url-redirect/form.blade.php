<div class="row">
    <form wire:submit.prevent="updateUrlRedirect" method="POST">
        <div class="row">

            <div class="col-12">
                <label for="url" class="form-label">URL After Login <span class="text-danger"><b>*</b></span></label>
                <input type="text" id="url" class="form-control @error('url') is-invalid @enderror"
                    placeholder="https://www.example.com/" wire:model="url" />
                @error('url') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>

    </form>
</div>
