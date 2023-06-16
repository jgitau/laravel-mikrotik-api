<div class="row">
    <form wire:submit.prevent="uploadLogo" method="POST">

        <div class="col-12">
            <x-input-field type="file" id="logo" label="Set Your Logo" model="logo" required />
        </div>

        <div class="mt-3 d-flex justify-content-between">
            <x-button type="submit" color="primary">
                Save
            </x-button>
            <x-button type="button" color="danger">
                Clear Logo
            </x-button>
        </div>

    </form>
</div>
