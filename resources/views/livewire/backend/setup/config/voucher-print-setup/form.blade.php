<div>
    <form action="#" class="invoice-repeater">
        <div class="d-flex">
            <div data-repeater-list="invoice" class="flex-grow-1">
                <div data-repeater-item>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" name="name" aria-describedby="name"
                                value="Turn on Wifi" />
                        </div>
                        <button type="button" class="btn btn-danger ms-2" data-repeater-delete>
                            <i data-feather="x" class="me-25"></i>
                            <span><i class="fas fa-trash"></i></span>
                        </button>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" name="name" aria-describedby="name"
                                placeholder="Open internet browser" value="Open internet browser" />
                        </div>
                        <button type="button" class="btn btn-danger ms-2" data-repeater-delete>
                            <i data-feather="x" class="me-25"></i>
                            <span><i class="fas fa-trash"></i></span>
                        </button>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" name="name" aria-describedby="name"
                                placeholder="Input username password" value="Input username password" />
                        </div>
                        <button type="button" class="btn btn-danger ms-2" data-repeater-delete>
                            <i data-feather="x" class="me-25"></i>
                            <span><i class="fas fa-trash"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-icon btn-primary" data-repeater-create>
            <i data-feather="plus"></i>
            <span><i class="fas fa-plus"></i></span>
        </button>
        <span id="max-item-message" class="ms-2 text-danger"></span>
    </form>
</div>

@push('scripts')
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script>
    // Initialize the repeater functionality
    $('.invoice-repeater, .repeater-default').repeater({
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
