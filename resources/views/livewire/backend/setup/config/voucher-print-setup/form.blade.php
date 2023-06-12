<div>
    <form wire:submit.prevent="updateVoucher" method="POST" class="invoice-repeater">
        <div class="d-flex">
            <div data-repeater-list="invoice" class="flex-grow-1">
                @foreach($invoice as $index => $item)
                <div data-repeater-item>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-grow-1">
                            <x-input-field id="name{{$index}}" label="Name" model="invoice.{{$index}}.name" type="text"
                                placeholder="Input value" required />
                        </div>
                        <button type="button" class="btn btn-danger ms-2 mt-4" data-repeater-delete>
                            <i data-feather="x" class="me-25"></i>
                            <span><i class="fas fa-trash"></i></span>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <button type="button" class="btn btn-icon btn-primary" data-repeater-create>
            <i data-feather="plus"></i>
            <span><i class="fas fa-plus"></i></span>
        </button>
        <span id="max-item-message" class="ms-2 text-danger"></span>
        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@push('scripts')
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script>
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
</script>
@endpush
