<div>
    <form wire:submit.prevent="updateVoucher" method="POST">
        @foreach($invoice as $index => $item)
        <div class="d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <x-input-field type="text" id="name{{$index}}" model="invoice.{{$index}}.name" placeholder="Input value"/>
            </div>

            @if($index != 0)
            <!-- Add this line -->
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
                Save
            </x-button>
        </div>
    </form>
</div>

@push('scripts')
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
{{-- <script>
    // Initialize the repeater functionality
    $('.invoice-repeater, .repeater-default').repeater({
        isFirstItemUndeletable: true,
        show: function () {
            $(this).slideDown(); // Show the repeated item
            checkMaxItemCount(); // Check the maximum item count
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                var self = this;
                $(this).slideUp(function() {
                    $(self).remove(); // Remove the deleted item
                    checkMaxItemCount(); // Check the maximum item count
                });
            }
        }
    });

    function checkMaxItemCount() {
        var maxItemCount = 5;
        var repeaterItems = $('.invoice-repeater [data-repeater-item]');
        var createButton = $('.invoice-repeater [data-repeater-create]');
        var maxItemMessage = $('#max-item-message');
        console.log(repeaterItems.length);

        if (repeaterItems.length >= maxItemCount) {
            createButton.prop('disabled', true); // Disable the create button
            maxItemMessage.text('Maximal 5 forms reached'); // Display the maximum forms reached message
        } else {
            createButton.prop('disabled', false); // Enable the create button
            maxItemMessage.text(''); // Clear the maximum forms reached message
        }
    }

    $(document).ready(function() {
        checkMaxItemCount(); // Check the maximum item count on page load
    });
</script> --}}
@endpush
