<div>
    <form wire:submit.prevent="updateVoucher" method="POST" enctype="multipart/form-data">
        @foreach($invoice as $index => $item)
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <x-input-field type="text" id="name{{$index}}" model="invoice.{{$index}}.name" placeholder="Input value"/>
            </div>

            @if($index != 0)
            <x-button type="button" color="danger" wire:click="removeInvoiceField({{$index}})" class="ms-2">
                <i data-feather="x" class="me-25"></i>
                <span><i class="fas fa-trash"></i></span>
            </x-button>
            @endif

        </div>
        @endforeach

        <x-button type="button" color="primary" wire:click="addInvoiceField">
            <i data-feather="plus"></i>
            <span><i class="fas fa-plus"></i></span>
        </x-button>

        @if (session()->has('error'))
        <span class="ms-2 text-danger">
            {{ session('error') }}
        </span>
        @endif
        <div class="d-flex justify-content-end mt-2">
            <x-button type="submit" color="primary">
                Save Changes
            </x-button>
        </div>
    </form>
</div>

@push('scripts')
@endpush
