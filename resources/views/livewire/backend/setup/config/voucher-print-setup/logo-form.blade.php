<div class="row">
    <form wire:submit.prevent="uploadLogo" method="POST">

        <div class="col-12">
            <x-input-field type="file" id="logo" label="Set Your Logo" model="logo"
                placeholder="https://www.example.com/.." required />
        </div>

        <div class="mt-3">
            <x-button type="submit" color="primary">
                Save
            </x-button>
        </div>

    </form>
</div>
